<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f2ed;
        }

        /* container mobile style */
        .app-container {
            max-width: 480px;
            margin: auto;
        }

        /* header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-wrapper {
            width: 40px;
            height: 40px;
            background: #5C3A21; /* coklat gelap */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-img {
            width: 22px;
            height: 22px;
            object-fit: contain;
        }

        .badge-table {
            background: #5C3A21;
            color: white;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px;
        }

        /* category tab */
        .category-wrapper {
            background: #e7dfd6;
            padding: 5px;
            border-radius: 20px;
            display: flex;
            gap: 5px;
        }

        .category-btn {
            flex: 1;
            border-radius: 20px;
            border: none;
            background: transparent;
            padding: 6px;
        }

        .category-active {
            background: white;
            font-weight: 500;
        }

        /* sub category */
        .sub-btn {
            border-radius: 20px;
            border: 1px solid #ccc;
            background: white;
            padding: 6px 12px;
            font-size: 13px;
        }

        .sub-active {
            background: #8B5E3C;
            color: white;
            border: none;
        }

        /* card */
        .menu-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }

        .menu-img {
            height: 120px;
            object-fit: cover;
        }

        .btn-add {
            background: #8B5E3C;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            padding: 4px 10px;
        }

        .price {
            font-weight: bold;
        }

        /* desktop improvement */
        @media(min-width: 768px){
            .app-container {
                max-width: 900px;
            }
        }

    </style>
</head>

<body>

<div class="container py-3 app-container">

    <div class="header mb-3">
    <div class="d-flex align-items-center gap-2">
        
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo/logo.png') }}" class="logo-img">
        </div>

        <h5 class="fw-bold mb-0">Cozy Cafe</h5>

    </div>

    <span class="badge-table">
        Meja {{ $tableData->table_number ?? '-' }}
    </span>
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
    <div class="col-6 col-md-4 menu-item"
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
                        data-price="{{ $menu->price }}">
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
let activeCategory = null;
let activeSub = null;

// mapping category → subcategory
const categoryMap = {
    "Food": ["Main Course", "Dessert"],
    "Drink": ["Coffee", "Non-Coffee"]
};

// filter menu
function filterMenu() {
    document.querySelectorAll('.menu-item').forEach(item => {
        let show = true;

        if (activeCategory && item.dataset.category !== activeCategory) {
            show = false;
        }

        if (activeSub && item.dataset.sub !== activeSub) {
            show = false;
        }

        item.style.display = show ? 'block' : 'none';
    });
}

// filter subcategory
function filterSubCategory() {
    document.querySelectorAll('.sub-btn').forEach(btn => {
        let subName = btn.dataset.sub;

        if (!activeCategory) {
            btn.style.display = 'inline-block';
        } else {
            btn.style.display = categoryMap[activeCategory].includes(subName)
                ? 'inline-block'
                : 'none';
        }
    });
}

// CLICK CATEGORY
document.querySelectorAll('.category-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        activeCategory = this.dataset.category;
        activeSub = null;

        // UI active
        document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('category-active'));
        this.classList.add('category-active');

        filterSubCategory();
        filterMenu();
    });
});

// CLICK SUBCATEGORY
document.querySelectorAll('.sub-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        activeSub = this.dataset.sub;

        // UI active
        document.querySelectorAll('.sub-btn').forEach(b => b.classList.remove('sub-active'));
        this.classList.add('sub-active');

        filterMenu();
    });
});

// default load (auto klik category pertama)
document.querySelector('.category-btn').click();
</script>

</body>
</html>