<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理系统</title>
    <link rel="stylesheet" href="/css/error.css">
</head>
<body>
<div class="container">
    @yield('content')
</div>
@yield('scripts')
</body>
</html>
