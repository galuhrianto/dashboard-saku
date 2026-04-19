<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tautan Tidak Valid — ICAO Diplomacy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  @vite ('resources/css/app.css')
</head>
<body class="flex min-h-screen items-center justify-center bg-(--background) p-6 text-(--foreground) antialiased">

  <div class="relative w-full max-w-sm">
    {{-- Dekorasi Glow Tipis agar tidak terlalu flat --}}
    <div class="absolute -top-12 -left-12 h-32 w-32 rounded-full bg-(--primary)/10 blur-3xl"></div>
    <div class="absolute -bottom-12 -right-12 h-32 w-32 rounded-full bg-blue-500/10 blur-3xl"></div>

    <div class="relative flex flex-col items-center justify-center">
      

      <div class="w-full text-center">
        {{-- Icon Error (Pakai gaya yang lebih clean) --}}
        <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-red-50 ring-8 ring-red-50/50 dark:bg-red-950/20 dark:ring-red-950/10">
          <svg class="h-10 w-10 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" y1="16" x2="12.01" y2="16" />
          </svg>
        </div>

        {{-- Heading & Text (Sesuai pilihanmu) --}}
        <div class="mb-10">
          <h2 class="text-2xl font-bold tracking-tight text-(--foreground)">Tautan Tidak Valid</h2>
          <p class="mt-3 text-sm leading-relaxed text-(--muted-foreground)">
            Maaf, tautan pengaturan ulang kata sandi Anda telah <b>kedaluwarsa</b> atau <b>sudah pernah digunakan</b> sebelumnya demi keamanan akun Anda.
          </p>
        </div>

        {{-- Action Button (Hanya Kembali ke Login) --}}
        <div class="space-y-4">
          <a
            href="/login"
            class="group inline-flex w-full items-center justify-center gap-2 rounded-(--radius) bg-(--primary) px-4 py-3 text-sm font-semibold text-(--primary-foreground) shadow-md transition-all hover:opacity-90 active:scale-[0.98]"
          >
            <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke Login
          </a>
        </div>

        {{-- Footer Kecil --}}
        <div class="mt-12 flex flex-col items-center gap-4">
         
          <p class="text-xs text-(--muted-foreground)">
            © {{ date('Y') }} Direktorat Jenderal Perhubungan Udara
          </p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>