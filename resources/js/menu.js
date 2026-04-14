/**
 * Logika Menu Cafe - Final Fix
 * Menangani filter kategori utama (Drink/Food) dan Sub-kategori
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Inisialisasi Elemen
    const mainTabsContainer = document.getElementById('main-tabs');
    const subTabsContainer  = document.getElementById('sub-tabs');
    const menuGridContainer = document.getElementById('menu-grid');
    const cartCountEl       = document.getElementById('cart-count');

    // Cek apakah data tersedia
    if (typeof menuData === 'undefined' || Object.keys(menuData).length === 0) {
        console.error("Data menuData tidak ditemukan atau kosong!");
        if(menuGridContainer) menuGridContainer.innerHTML = '<div class="empty-state">Data menu tidak tersedia.</div>';
        return;
    }

    // 2. State Aplikasi
    const mainCategories = Object.keys(menuData);
    let activeMain = mainCategories[0]; // Default: Drink
    let activeSub  = Object.keys(menuData[activeMain])[0]; // Default: Sub-kategori pertama

    // 3. Fungsi Render Utama
    function renderApp() {
        renderMainTabs();
        renderSubTabs();
        renderMenuGrid();
    }

    // 4. Render Tab Utama (Drink & Food)
    function renderMainTabs() {
        mainTabsContainer.innerHTML = '';
        mainCategories.forEach(cat => {
            const btn = document.createElement('button');
            btn.className = `tab-btn ${cat === activeMain ? 'active' : ''}`;
            btn.textContent = cat.charAt(0).toUpperCase() + cat.slice(1);
            
            btn.onclick = () => {
                activeMain = cat;
                // Saat ganti Drink -> Food, otomatis pilih sub-kategori pertama di Food
                const newSubs = Object.keys(menuData[cat] || {});
                activeSub = newSubs.length > 0 ? newSubs[0] : null;
                renderApp();
            };
            mainTabsContainer.appendChild(btn);
        });
    }

    // 5. Render Sub Tabs (Coffee, Non-Coffee, dsb)
    function renderSubTabs() {
        subTabsContainer.innerHTML = '';
        const subs = Object.keys(menuData[activeMain] || {});
        
        subs.forEach(sub => {
            const btn = document.createElement('button');
            btn.className = `sub-btn ${sub === activeSub ? 'active' : ''}`;
            btn.textContent = sub.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
            
            btn.onclick = () => {
                activeSub = sub;
                renderApp();
            };
            subTabsContainer.appendChild(btn);
        });
    }

    // 6. Render Grid Menu
    function renderMenuGrid() {
        menuGridContainer.innerHTML = '';
        const items = (menuData[activeMain] && menuData[activeMain][activeSub]) 
                      ? menuData[activeMain][activeSub] 
                      : [];

        if (items.length === 0) {
            menuGridContainer.innerHTML = '<div class="empty-state">Menu belum tersedia untuk kategori ini.</div>';
            return;
        }

        items.forEach(item => {
            const card = document.createElement('div');
            card.className = 'menu-card';
            
            // Format Rupiah
            const priceFormatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(item.price);

            card.innerHTML = `
                <div class="menu-card-img">
                    <img src="${item.image_url || '/images/default-menu.jpg'}" alt="${item.name}" loading="lazy">
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-name">${item.name}</div>
                    <div class="menu-card-desc">${item.description || ''}</div>
                    <div class="menu-card-footer">
                        <span class="menu-price">${priceFormatted}</span>
                        <button class="add-btn" onclick="handleAddToCart()">+</button>
                    </div>
                </div>
            `;
            menuGridContainer.appendChild(card);
        });
    }

    // 7. Fungsi Tambah ke Keranjang (Global agar bisa diakses onclick)
    window.handleAddToCart = function() {
        let currentCount = parseInt(cartCountEl.innerText);
        cartCountEl.innerText = currentCount + 1;
        
        // Animasi kecil pada FAB
        const fab = document.querySelector('.cart-fab');
        fab.style.transform = 'scale(1.1)';
        setTimeout(() => fab.style.transform = 'scale(1)', 200);
    };

    // Jalankan render pertama kali
    renderApp();
});