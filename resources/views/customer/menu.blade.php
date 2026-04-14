<!DOCTYPE html>
<html>
<head>
    <title>Menu Cafe</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>

<div class="phone-frame">

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="cafe-brand">
            <div class="icon">☕</div>
            My Cafe
        </div>
        <div class="table-badge">Table 01</div>
    </div>

    <!-- Main Tabs -->
    <div class="tab-row">
        <button class="tab-btn active" onclick="switchMain('food', this)">Food</button>
        <button class="tab-btn" onclick="switchMain('drink', this)">Drink</button>
    </div>

    <!-- Sub Tabs -->
    <div class="sub-tabs" id="sub-tabs"></div>

    <!-- Menu Grid -->
    <div class="menu-grid" id="menu-grid"></div>

    <!-- Cart Button -->
    <div class="cart-fab">
        🛒
        <div class="cart-count">0</div>
    </div>

</div>

<!-- Data dari Laravel -->
<script>
    const menuData = @json($menuData);
</script>

<!-- JS -->
<script src="{{ asset('js/menu.js') }}"></script>

</body>
</html>