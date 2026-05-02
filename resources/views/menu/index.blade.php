<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/menu.css')
</head>

<body>

<div class="container py-3 app-container">

    <div class="header mb-3 d-flex justify-content-between align-items-center">

    <!-- KIRI: LOGO + NAMA -->
    <div class="d-flex align-items-center gap-2">
        
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo/logo.png') }}" class="logo-img">
        </div>

        <h5 class="fw-bold mb-0">Cozy Cafe</h5>
    </div>

    <!-- KANAN: MEJA + CART -->
    <div class="d-flex align-items-center gap-2">

        <span class="badge-table">
            Meja {{ $tableData->table_number ?? '-' }}
        </span>

        <!-- CART ICON -->
        <div class="cart-header" onclick="goToCart()">
            <img src="{{ asset('images/icons/cart.png') }}" class="cart-icon">
            <span id="cart-count">0</span>
        </div>

        

    </div>
</div>

    <!-- CATEGORY -->
    <div class="category-wrapper mb-3">
        @foreach($categories as $index => $cat)
            <button class="category-btn {{ $index == 0 ? 'category-active' : '' }}"
            data-category="{{ $cat->name }}">
            {{ $cat->name }}
            </button>
        @endforeach
    </div>

    <!-- SUBCATEGORY -->
    <div class="mb-3 d-flex gap-2 flex-wrap">
        @foreach($subCategories as $index => $sub)
            <button class="sub-btn {{ $index == 0 ? 'sub-active' : '' }}"
                data-sub="{{ $sub->name }}">
                {{ $sub->name }}
            </button>
        @endforeach
    </div>

    

    <!-- MENU -->
<div class="row g-3">
    @foreach($menus as $menu)
    <div class="col-6 col-lg-4 menu-item"
         data-category="{{ $menu->category_name }}"
         data-sub="{{ $menu->sub_name }}">

        <div class="card menu-card shadow-sm">

            <img src="{{ asset($menu->image_url) }}" class="menu-img w-100">

            <div class="p-2">

                <div class="fw-semibold" style="font-size: 14px;">
                    {{ $menu->name }}
                </div>

                <div class="text-muted" style="font-size: 12px;">
                    {{ $menu->description }}
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="price">
                        Rp {{ number_format($menu->price) }}
                    </span>

                    <button class="btn btn-add btn-sm add-to-cart"
                        data-id="{{ $menu->menu_id }}"
                        data-name="{{ $menu->name }}"
                        data-price="{{ $menu->price }}"
                        data-order-id="1">   {{-- sesuaikan dengan order_id yang aktif --}}
                        Add
                    </button>
                </div>

            </div>

        </div>

    </div>
    @endforeach
</div>





</div>

<script>
// ── Filter Category & SubCategory ──────────────────────────────────────────

let activeCategory = null;
let activeSub = null;

const categoryMap = {
    "Food": ["Main Course", "Dessert"],
    "Drink": ["Coffee", "Non-Coffee"]
};

function filterMenu() {
    document.querySelectorAll('.menu-item').forEach(item => {
        let show = true;
        if (activeCategory && item.dataset.category !== activeCategory) show = false;
        if (activeSub && item.dataset.sub !== activeSub) show = false;
        item.style.display = show ? 'block' : 'none';
    });
}

function filterSubCategory() {
    document.querySelectorAll('.sub-btn').forEach(btn => {
        const subName = btn.dataset.sub;
        btn.style.display = (!activeCategory || categoryMap[activeCategory]?.includes(subName))
            ? 'inline-block' : 'none';
    });
}

document.querySelectorAll('.category-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        activeCategory = this.dataset.category;
        activeSub = null;
        document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('category-active'));
        this.classList.add('category-active');
        filterSubCategory();
        filterMenu();
    });
});

document.querySelectorAll('.sub-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        activeSub = this.dataset.sub;
        document.querySelectorAll('.sub-btn').forEach(b => b.classList.remove('sub-active'));
        this.classList.add('sub-active');
        filterMenu();
    });
});

document.querySelector('.category-btn').click();


// ── Cart (AJAX ke database) ────────────────────────────────────────────────

const CSRF_TOKEN = "{{ csrf_token() }}";

/**
 * Ambil total qty dari DB lalu update badge
 */
async function refreshCartBadge(orderId) {
    try {
        const res  = await fetch(`/cart/count/${orderId}`);
        const data = await res.json();
        document.getElementById('cart-count').innerText = data.count ?? 0;
    } catch (e) {
        console.error('Gagal refresh badge:', e);
    }
}

/**
 * Kirim item ke DB via AJAX, lalu refresh badge
 */
async function addToCartAjax(menuId, orderId, btnEl) {
    // Feedback visual
    btnEl.disabled = true;
    btnEl.innerText = '...';

    try {
        const res = await fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify({ menu_id: menuId, order_id: orderId }),
        });

        if (!res.ok) throw new Error(`HTTP ${res.status}`);

        // Refresh badge dari DB
        await refreshCartBadge(orderId);

        // Feedback sukses
        btnEl.innerText = '✓';
        setTimeout(() => { btnEl.innerText = 'Add'; btnEl.disabled = false; }, 800);

    } catch (e) {
        console.error('Gagal tambah item:', e);
        btnEl.innerText = '!';
        setTimeout(() => { btnEl.innerText = 'Add'; btnEl.disabled = false; }, 1000);
    }
}

// Pasang event listener ke semua tombol Add
document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', function () {
        const menuId  = this.dataset.id;
        const orderId = this.dataset.orderId;   // dari data-order-id
        addToCartAjax(menuId, orderId, this);
    });
});

// Redirect ke cart
function goToCart() {
    // Ambil order_id dari tombol Add pertama yang ada
    const firstBtn = document.querySelector('.add-to-cart');
    const orderId  = firstBtn ? firstBtn.dataset.orderId : 1;
    window.location.href = `/cart/${orderId}`;
}

// Reset cart (testing) — hapus juga kalau sudah tidak perlu
function clearCart() {
    localStorage.removeItem("cart");
    document.getElementById('cart-count').innerText = 0;
}

// Init: load badge dari DB saat halaman dibuka
const firstBtn = document.querySelector('.add-to-cart');
if (firstBtn) refreshCartBadge(firstBtn.dataset.orderId);

</script>

</body>
</html>