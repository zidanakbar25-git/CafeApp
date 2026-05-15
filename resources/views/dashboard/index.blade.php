<!DOCTYPE html>
<html>
<head>
    <title>Cafe Dashboard</title>
</head>
<body style="margin:0; font-family:Arial;">

<div style="display:flex;">

    <!-- SIDEBAR -->
    <div style="width:220px; height:100vh; background:#eee; padding:15px;">

        <h3>CAFE APP</h3>

        <a href="/dashboard">Home</a><br><br>

        @if(auth()->user()->role == 'manager')
            <a href="#">Laporan</a><br><br>
            <a href="#">User Management</a><br><br>
        @endif

        <a href="#">Orders</a><br><br>

        <hr>

        <a href="/logout">Logout</a>

    </div>

    <!-- CONTENT -->
    <div style="flex:1; padding:20px;">

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