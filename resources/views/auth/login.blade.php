<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<form method="POST" action="/login" class="bg-white p-6 rounded-xl shadow w-80">
    @csrf

    <div class="text-center mb-4">
    <h2 class="text-xl font-bold">Login</h2>
    <p class="text-gray-500 text-sm">One on One Diplomacy Ebook test test</p>
</div>

    @if(session('error'))
        <p class="text-red-500 text-sm mb-2">{{ session('error') }}</p>
    @endif

    <input type="text" name="username" placeholder="Username"
        class="w-full mb-3 px-3 py-2 border rounded">

    <input type="password" name="password" placeholder="Password"
        class="w-full mb-4 px-3 py-2 border rounded">

    <button class="w-full bg-blue-600 text-white py-2 rounded">
        Login
    </button>
</form>

</body>
</html><!DOCTYPE html>
