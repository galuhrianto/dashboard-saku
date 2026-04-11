<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login — ICAO Diplomacy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
    rel="stylesheet"
  />
  @vite ('resources/css/app.css')
</head>
<body class="min-h-screen bg-(--background) text-(--foreground) antialiased">
  <div class="flex min-h-screen">
    {{-- ── LEFT PANEL: Branding ── --}}
    <div class="relative hidden overflow-hidden lg:flex lg:w-1/2 xl:w-[55%]">
      {{-- Base gradient using primary color --}}
      <div
        class="absolute inset-0"
        style="
          background: linear-gradient(
            145deg,
            oklch(0.36 0.18 264) 0%,
            oklch(0.488 0.243 264.376) 55%,
            oklch(0.56 0.22 258) 100%
          );
        "
      ></div>

      {{-- Subtle grid overlay --}}
      <div
        class="absolute inset-0 opacity-[0.07]"
        style="
          background-image:
            linear-gradient(rgba(255, 255, 255, 0.6) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.6) 1px, transparent 1px);
          background-size: 48px 48px;
        "
      ></div>

      {{-- Glow orbs --}}
      <div
        class="absolute -top-24 -left-24 h-72 w-72 rounded-full opacity-30"
        style="
          background: radial-gradient(circle, oklch(0.75 0.15 220), transparent 70%);
          filter: blur(48px);
        "
      ></div>
      <div
        class="absolute right-0 bottom-0 h-80 w-80 rounded-full opacity-20"
        style="
          background: radial-gradient(circle, oklch(0.85 0.1 280), transparent 70%);
          filter: blur(64px);
        "
      ></div>

      {{-- Content --}}
      <div class="relative z-10 flex flex-col justify-between p-10 xl:p-14">
        {{-- Logo / wordmark --}}
        <div class="flex items-center gap-3">
          <div
            class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15 ring-1 ring-white/20 backdrop-blur-sm"
          >
            <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
              <path d="M2 12h20" />
            </svg>
          </div>
          <span class="text-sm font-semibold tracking-wide text-white/90">ICAO Diplomacy</span>
        </div>

        {{-- Main headline --}}
        <div class="space-y-6">
          <div>
            <p class="mb-3 text-xs font-semibold tracking-[0.18em] text-white/50 uppercase">Kementerian Perhubungan RI</p>
            <h1 class="text-3xl leading-tight font-bold text-white xl:text-4xl">
              One on One<br />Diplomacy<br />e-Book
            </h1>
          </div>
          <p class="max-w-xs text-sm leading-relaxed text-white/60">Platform informasi strategis untuk mendukung pencalonan Indonesia sebagai anggota Dewan ICAO.</p>

          {{-- Decorative stat chips --}}
          <div class="flex flex-wrap gap-2 pt-2">
            <span
              class="rounded-full bg-white/10 px-3 py-1.5 text-xs font-medium text-white/80 ring-1 ring-white/15 backdrop-blur-sm"
            >
              192 Negara Anggota
            </span>
            <span
              class="rounded-full bg-white/10 px-3 py-1.5 text-xs font-medium text-white/80 ring-1 ring-white/15 backdrop-blur-sm"
            >
              Data Strategis ICAO
            </span>
          </div>
        </div>

        {{-- Footer note --}}
        <p class="text-xs text-white/30">© {{ date('Y') }} Direktorat Jenderal Perhubungan Udara</p>
      </div>
    </div>

    {{-- ── RIGHT PANEL: Form ── --}}
    <div
      class="flex flex-1 flex-col items-center justify-center px-6 py-12 sm:px-10 lg:px-14 xl:px-20"
    >
      {{-- Mobile logo --}}
      <div class="mb-8 flex items-center gap-2.5 lg:hidden">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-(--primary)">
          <svg class="h-4.5 w-4.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
            <path d="M2 12h20" />
          </svg>
        </div>
        <span class="text-sm font-semibold">ICAO Diplomacy</span>
      </div>

      <div class="w-full max-w-sm">
        {{-- Heading --}}
        <div class="mb-8">
          <h2 class="text-2xl font-bold tracking-tight text-(--foreground)">Selamat datang</h2>
          <p class="mt-1.5 text-sm text-(--muted-foreground)">Masuk untuk mengakses dashboard negara ICAO.</p>
        </div>

        {{-- Error alert --}}
        @if (session('error'))
          <div
            class="mb-5 flex items-start gap-2.5 rounded-lg border border-red-200 bg-red-50 px-4 py-3"
          >
            <svg class="mt-0.5 h-4 w-4 shrink-0 text-red-500" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm text-red-700">{{ session('error') }}</p>
          </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="/login" class="space-y-5">
          @csrf

          {{-- Username --}}
          <div class="space-y-1.5">
            <label for="username" class="block text-sm font-medium text-(--foreground)">
              Username
            </label>
            <input
              id="username"
              type="text"
              name="username"
              autocomplete="username"
              placeholder="Masukkan username"
              required
              autofocus
              class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm text-(--foreground) transition-all outline-none placeholder:text-(--muted-foreground)/60 focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/25"
            />
          </div>

          {{-- Password --}}
          <div class="space-y-1.5">
            <label for="password" class="block text-sm font-medium text-(--foreground)">
              Password
            </label>
            <div class="relative">
              <input
                id="password"
                type="password"
                name="password"
                autocomplete="current-password"
                placeholder="Masukkan password"
                required
                class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 pr-10 text-sm text-(--foreground) transition-all outline-none placeholder:text-(--muted-foreground)/60 focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/25"
              />
              {{-- Toggle visibility button --}}
              <button
                type="button"
                id="togglePassword"
                tabindex="-1"
                class="absolute top-1/2 right-3 -translate-y-1/2 text-(--muted-foreground) transition-colors hover:text-(--foreground)"
                aria-label="Toggle password visibility"
              >
                <svg id="eyeIcon" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                  <circle cx="12" cy="12" r="3" />
                </svg>
              </button>
            </div>
          </div>

          {{-- Submit --}}
          <button
            type="submit"
            class="mt-1 inline-flex w-full items-center justify-center gap-2 rounded-(--radius) bg-(--primary) px-4 py-2.5 text-sm font-semibold text-(--primary-foreground) shadow-sm transition-all hover:opacity-90 focus:ring-2 focus:ring-(--primary)/50 focus:ring-offset-2 focus:ring-offset-(--background) focus:outline-none active:scale-[0.99]"
          >
            Masuk
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </button>
        </form>

        {{-- Divider --}}
        <div class="mt-8 flex items-center gap-3">
          <div class="h-px flex-1 bg-(--border)"></div>
          <p class="text-[11px] text-(--muted-foreground)">ICAO Council Candidacy 2026</p>
          <div class="h-px flex-1 bg-(--border)"></div>
        </div>

        <p class="mt-6 text-center text-[11px] text-(--muted-foreground)">© DJPU &mdash; Bagian Organisasi dan Tata Laksana</p>
      </div>
    </div>
  </div>

  <script>
    const btn = document.getElementById('togglePassword');
    const input = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    const eyeOpen = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    const eyeClosed = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;

    btn.addEventListener('click', () => {
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      icon.innerHTML = isPassword ? eyeClosed : eyeOpen;
    });
  </script>
</body>
</html>
