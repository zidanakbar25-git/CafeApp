<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cafe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
<div class="phone-frame">
    <div class="top-bar">
        <div class="cafe-brand">
            <div class="cafe-icon">☕</div>
            <span>My Cafe</span>
        </div>
        <div class="table-badge">Table 01</div>
    </div>

    <div class="tab-row" id="main-tabs">
        </div>

    <div class="sub-tab-row" id="sub-tabs">
        </div>

    <div class="menu-grid" id="menu-grid">
        </div>

    <div class="cart-fab" onclick="openCart()">
        <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
        </svg>
        <div class="cart-count" id="cart-count">0</div>
    </div>
</div>

<script>
    // Sangat Penting: Pastikan variabel ini menerima data array/object dari Controller
    const menuData = @json($menuData);
    
    // Debugging: Cek di inspect element (F12) Console apakah data muncul
    console.log("Menu Data Loaded:", menuData);
</script>

<script src="{{ asset('js/menu.js') }}"></script>

<script>
    function openCart() {
        alert("Fitur keranjang akan segera hadir!");
    }
</script>
</body>
</html>