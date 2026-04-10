<!DOCTYPE html>
<html>
<head>
    <title>One on One Diplomacy Ebook</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

@include('partials.header')

<div class="p-6">
    @yield('content')
</div>

@yield('scripts')
</body>
</html>