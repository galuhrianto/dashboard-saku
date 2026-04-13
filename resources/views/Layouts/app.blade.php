<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>One on One Diplomacy Ebook</title>
  @vite ('resources/css/app.css')
</head>
<body class="min-h-screen bg-(--background) text-(--foreground) antialiased">
  @include ('partials.header')

  <div class="mx-auto w-full max-w-7xl p-4 sm:p-6">
    @yield ('content')
  </div>
  @include ('partials.footer')

  @yield ('scripts')
</body>
</html>
