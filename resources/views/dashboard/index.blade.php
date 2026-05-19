<!DOCTYPE html>
<html>
<head>
    <title>Cafe Dashboard</title>
</head>
<body style="margin:0; font-family:Arial;">

<div class="admin-layout">

    @include('dashboard.layout.sidebar')

    <!-- CONTENT -->
    <div class="admin-content" style="padding:20px;">

        <h1>Dashboard</h1>

        @if(auth()->user()->role == 'manager')
            <h2>Welcome Manager</h2>
        @else
            <h2>Welcome Cashier</h2>
        @endif

    </div>

</div>

</body>
</html>