<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>application</title>
</head>
<body>
    <div class='navBar'>
        <div class='logo'>GDguessr</div>
        <a href='{{ route('gamemode') }}'>Play</a>
        <a href='{{ route('sCode') }}'>SourceCode</a>
    </div>
    <div class='content'>
        @yield('content')
</body>
</html> 