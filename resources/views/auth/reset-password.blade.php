<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password — ICAO Diplomacy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />
    @vite ('resources/css/app.css')
</head>

<body class="flex min-h-screen items-center justify-center bg-(--background) p-6 text-(--foreground) antialiased">

    <div class="w-full max-w-sm">

        {{-- Heading --}}
        <div class="mb-8">
            <h2 class="text-2xl font-bold tracking-tight text-(--foreground)">Reset Password</h2>
            <p class="mt-1.5 text-sm text-(--muted-foreground)">Silakan masukkan kata sandi baru untuk akun Anda.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="/reset-password" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="username" value="{{ $username }}">

            {{-- Password Baru --}}
            <div class="space-y-1.5">
                <label for="password" class="block text-sm font-medium text-(--foreground)">Password Baru</label>
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="••••••••" required autofocus
                        class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 pr-10 text-sm text-(--foreground) transition-all outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/25" />
                    <div class="match-badge absolute inset-y-0 right-3 hidden items-center text-green-600">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                {{-- Syarat Password --}}
                <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-2 px-0.5">
                    <div id="req-min"
                        class="flex items-center gap-2 text-[10px] sm:text-[11px] text-(--muted-foreground) transition-colors italic">
                        <svg class="h-3 w-3 invisible" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                        Minimal 8 Karakter
                    </div>

                    <div id="req-case"
                        class="flex items-center gap-2 text-[10px] sm:text-[11px] text-(--muted-foreground) transition-colors italic">
                        <svg class="h-3 w-3 invisible" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                        Huruf Besar & Kecil
                    </div>

                    <div id="req-number"
                        class="flex items-center gap-2 text-[10px] sm:text-[11px] text-(--muted-foreground) transition-colors italic">
                        <svg class="h-3 w-3 invisible" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                        Mengandung Angka
                    </div>

                    <div id="req-symbol"
                        class="flex items-center gap-2 text-[10px] sm:text-[11px] text-(--muted-foreground) transition-colors italic">
                        <svg class="h-3 w-3 invisible" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                        Mengandung Simbol
                    </div>
                </div>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-sm font-medium text-(--foreground)">Konfirmasi
                    Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="••••••••" required
                        class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 pr-10 text-sm text-(--foreground) transition-all outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/25" />
                    <div class="match-badge absolute inset-y-0 right-3 hidden items-center text-green-600">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="3">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Keamanan Note --}}
            <div class="rounded-(--radius) border border-(--border) bg-(--muted)/20 px-3.5 py-2.5">
                <div class="flex gap-2 text-[11px] text-(--muted-foreground)">
                    <svg class="h-3.5 w-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    <p>Tautan ini hanya berlaku <b>60 menit</b> dan untuk <b>satu kali</b> penggantian.</p>
                </div>
            </div>

            <button type="submit"
                class="inline-flex w-full items-center justify-center gap-2 rounded-(--radius) bg-(--primary) px-4 py-2.5 text-sm font-semibold text-(--primary-foreground) shadow-sm transition-all hover:opacity-90 active:scale-[0.99]">
                Simpan Password Baru
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </button>
        </form>

        <p class="mt-8 text-center text-[11px] text-(--muted-foreground)">© {{ date('Y') }} Direktorat Jenderal
            Perhubungan Udara</p>
    </div>

    <script>
        const p1 = document.getElementById('password');
        const p2 = document.getElementById('password_confirmation');
        const matchBadges = document.querySelectorAll('.match-badge');

        const reqs = {
            min: {
                el: document.getElementById('req-min'),
                reg: /.{8,}/
            },
            case: {
                el: document.getElementById('req-case'),
                reg: /^(?=.*[a-z])(?=.*[A-Z]).+$/
            },
            number: {
                el: document.getElementById('req-number'),
                reg: /[0-9]/
            },
            symbol: {
                el: document.getElementById('req-symbol'),
                reg: /[^A-Za-z0-9]/
            }
        };

        function validate() {
            const val = p1.value;
            const confirmVal = p2.value;

            // Update checklist syarat password
            Object.keys(reqs).forEach(key => {
                const isValid = reqs[key].reg.test(val);
                const el = reqs[key].el;
                const icon = el.querySelector('svg');

                if (isValid) {
                    el.classList.replace('text-(--muted-foreground)', 'text-green-600');
                    el.classList.add('not-italic');
                    icon.classList.remove('invisible');
                } else {
                    el.classList.replace('text-green-600', 'text-(--muted-foreground)');
                    el.classList.remove('not-italic');
                    icon.classList.add('invisible');
                }
            });

            // Update badge kecocokan di kedua field
            const isMatch = val !== '' && val === confirmVal;
            matchBadges.forEach(badge => {
                isMatch ? badge.classList.replace('hidden', 'flex') : badge.classList.replace('flex', 'hidden');
            });
        }

        p1.addEventListener('input', validate);
        p2.addEventListener('input', validate);
    </script>
</body>

</html>
