<!-- INI TEMPLATE UTAMA HARAP JANGAN DIUBAH-UBAH YA, 
KALAU MAU NGE-EDIT BAGIAN TITLE DAN CONTENT YA 
EDIT DI HOME.BLADE.PHP YA TEMAN-TEMAN,JANGAN 
DI SINI, TERIMA KASIH -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- panggil header --}}
    @include('layouts.header')
   
<br>

    {{-- isi konten --}}
    <div class="m-5">
    @yield('content')
    </div>

</body>
</html>