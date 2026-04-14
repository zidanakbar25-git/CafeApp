let currentMain = 'food';
let currentSub = '';

function switchMain(main, btn) {
    currentMain = main;

    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    renderSubTabs();
}

function renderSubTabs() {
    let subTabsHTML = '';
    const subs = Object.keys(menuData[currentMain]);

    currentSub = subs[0];

    subs.forEach((sub, index) => {
        subTabsHTML += `
            <button class="sub-tab ${index === 0 ? 'active' : ''}" 
                    onclick="switchSub('${sub}', this)">
                ${sub}
            </button>
        `;
    });

    document.getElementById('sub-tabs').innerHTML = subTabsHTML;

    renderMenu();
}

function switchSub(sub, btn) {
    currentSub = sub;

    document.querySelectorAll('.sub-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    renderMenu();
}

function renderMenu() {
    let html = '';

    menuData[currentMain][currentSub].forEach(item => {
        html += `
            <div class="menu-card">
                <div class="menu-card-img-placeholder">🍽️</div>

                <div class="menu-card-body">
                    <div class="menu-card-name">${item.name}</div>
                    <div class="menu-card-desc">Delicious menu</div>

                    <div class="menu-card-footer">
                        <div class="price">Rp ${item.price}</div>
                        <button class="add-btn">+</button>
                    </div>
                </div>
            </div>
        `;
    });

    document.getElementById('menu-grid').innerHTML = html;
}

// init saat halaman load
document.addEventListener('DOMContentLoaded', function () {
    renderSubTabs();
});