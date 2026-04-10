<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  @vite ('resources/css/app.css')
</head>
<body class="min-h-screen overflow-x-hidden bg-(--background) text-(--foreground) antialiased">
  <div
    class="relative isolate flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-8"
  >
    <div class="pointer-events-none absolute inset-0 -z-10">
      <div
        class="bg-(--primary)]/20 absolute top-[-18%] left-[-12%] h-72 w-72 rounded-full blur-3xl"
      ></div>
      <div
        class="absolute right-[-8%] bottom-[-12%] h-80 w-80 rounded-full bg-(--primary)/35 blur-3xl"
      ></div>
      <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.65),_transparent_60%)]"
      ></div>
    </div>

    <div
      class="w-full max-w-md rounded-2xl border border-[var(--border)] bg-[var(--card)]/90 p-6 shadow-2xl backdrop-blur-xl sm:p-8"
    >
      <div class="mb-6 text-center sm:mb-7">
        <span
          class="inline-flex items-center rounded-full border border-[var(--border)] bg-[var(--secondary)] px-3 py-1 text-xs font-semibold tracking-[0.12em] text-[var(--muted-foreground)] uppercase"
        >
          Secure Access
        </span>
        <h1 class="mt-4 text-2xl leading-tight font-semibold sm:text-3xl">Welcome Back</h1>
        <p class="mt-2 text-sm text-[var(--muted-foreground)]">Sign in to continue to One on One Diplomacy Ebook.</p>
      </div>

      @if (session('error'))
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-600">
          {{ session('error') }}
        </div>
      @endif

      <form method="POST" action="/login" class="space-y-4">
        @csrf

        <div class="space-y-2">
          <label for="username" class="text-sm font-medium text-[var(--foreground)]"
            >Username</label
          >
          <input
            id="username"
            type="text"
            name="username"
            placeholder="Enter your username"
            class="w-full rounded-[var(--radius)] border border-[var(--input)] bg-white px-3.5 py-2.5 text-sm text-[var(--foreground)] transition outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/35"
            required
            autofocus
          />
        </div>

        <div class="space-y-2">
          <label for="password" class="text-sm font-medium text-[var(--foreground)]"
            >Password</label
          >
          <input
            id="password"
            type="password"
            name="password"
            placeholder="Enter your password"
            class="w-full rounded-[var(--radius)] border border-[var(--input)] bg-white px-3.5 py-2.5 text-sm text-[var(--foreground)] transition outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--ring)]/35"
            required
          />
        </div>

        <button
          type="submit"
          class="mt-2 inline-flex w-full items-center justify-center rounded-[var(--radius)] bg-[var(--primary)] px-4 py-2.5 text-sm font-semibold text-[var(--primary-foreground)] shadow-lg shadow-blue-500/20 transition hover:brightness-105 focus:ring-2 focus:ring-[var(--ring)] focus:ring-offset-2 focus:ring-offset-[var(--background)] focus:outline-none"
        >
          Login
        </button>
      </form>
    </div>
  </div>
</body>
</html>
