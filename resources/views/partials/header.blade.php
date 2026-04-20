<nav class="sticky top-0 z-30 border-b border-(--border) bg-(--background)/85 backdrop-blur-xl">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6">

        <!-- LEFT -->
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="text-base font-semibold tracking-tight sm:text-lg">
                One on One Diplomacy Ebook
            </a>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex items-center gap-3 border-l border-(--muted-foreground) pl-4 sm:gap-4 sm:pl-6">
                <a href="{{ route('astacita') }}"
                    class="text-xs font-medium text-(--muted-foreground) transition hover:text-(--primary) sm:text-sm">
                    Asta Cita
                </a>
                <a href="{{ route('icaoheadoffice') }}"
                    class="text-xs font-medium text-(--muted-foreground) transition hover:text-(--primary) sm:text-sm">
                    The ICAO Head Office
                </a>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-2">

            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton"
                class="sm:hidden inline-flex h-8 w-8 items-center justify-center rounded-(--radius) border border-(--border)">
                ☰
            </button>

            @auth
                {{-- @if (auth()->user()->role_id == 1)
                    <div class="relative hidden sm:block">
                        <span> Hi,</span>
                        <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'"
                            id="userMenuButton"
                            class="inline-flex h-8 items-center rounded-(--radius) border border-(--border) bg-(--secondary) px-3 py-1.5 text-sm font-medium text-(--foreground) transition hover:border-(--primary)">
                            {{ auth()->user()->name }}
                        </button>
                    </div>
                @endif --}}

                <div class="relative hidden sm:block">
                    <span> Hi,</span>

                    @if (auth()->user()->role_id == 1)
                        {{-- Jika Admin: Bisa diklik --}}
                        <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'"
                            class="inline-flex h-8 items-center rounded-(--radius) border border-(--border) bg-(--secondary) px-3 py-1.5 text-sm font-medium text-(--foreground) transition hover:border-(--primary) cursor-pointer">
                            {{ auth()->user()->name }}
                        </button>
                    @else
                        {{-- Selain Admin: Tampilan sama tapi tidak bisa dipencet --}}
                        <div
                            class="inline-flex h-8 items-center rounded-(--radius) border border-(--border) px-3 py-1.5 text-sm text-(--foreground) cursor-default">
                            {{ auth()->user()->name }}
                        </div>
                    @endif
                </div>

                <button id="themeToggle" type="button"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-(--radius) border border-(--border) bg-(--secondary) text-(--secondary-foreground) transition hover:border-(--primary) hover:text-(--primary)">
                    <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" class="h-4 w-4">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </svg>

                    <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" class="hidden h-4 w-4">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9z"></path>
                    </svg>
                </button>

                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                    @csrf
                    <button
                        class="inline-flex h-8 items-center rounded-(--radius) bg-(--destructive) px-3 py-1.5 text-xs font-semibold text-white transition hover:brightness-110 sm:text-sm">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden sm:hidden absolute left-0 top-full w-full px-4 pt-2 z-40">

        <div class="rounded-xl border border-(--border) bg-(--card) shadow-lg p-3 space-y-2">

            <!-- MENU -->
            <a href="{{ route('astacita') }}"
                class="block rounded-lg px-3 py-2 text-sm text-(--foreground) hover:bg-(--accent) transition">
                Asta Cita
            </a>

            <a href="{{ route('icaoheadoffice') }}"
                class="block rounded-lg px-3 py-2 text-sm text-(--foreground) hover:bg-(--accent) transition">
                The ICAO Head Office
            </a>

            @auth
                <div class="mt-3 border-t border-(--border) pt-3">

                    <div class="space-y-1">
                        @if (auth()->user()->role_id == 1)
                            {{-- Jika Admin: Link Aktif --}}
                            <a href="{{ route('admin.dashboard') }}"
                                class="block mt-2 rounded-lg px-3 py-2 text-sm text-(--foreground) hover:bg-(--accent) transition">
                                Hi, <span class="text-(--foreground)">{{ auth()->user()->name }}</span>
                            </a>
                        @else
                            {{-- Selain Admin: Hanya Label/Informasi Nama --}}
                            <div
                                class="block mt-2 px-3 py-2 text-sm text-(--muted-foreground)  border-(--border)">
                                Hi, <span class="text-(--foreground)">{{ auth()->user()->name }}</span>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button
                            class="w-full text-left rounded-lg px-3 py-2 text-sm text-red-500 hover:bg-red-500/10 transition">
                            Logout
                        </button>
                    </form>

                </div>
            @endauth

        </div>
    </div>
</nav>

<script>
    const root = document.documentElement;
    const themeToggle = document.getElementById('themeToggle');
    const iconSun = document.getElementById('iconSun');
    const iconMoon = document.getElementById('iconMoon');
    const userMenuButton = document.getElementById('userMenuButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    function updateThemeIcon() {
        if (!iconSun || !iconMoon) return;

        if (root.classList.contains('dark')) {
            iconSun.classList.remove('hidden');
            iconMoon.classList.add('hidden');
        } else {
            iconSun.classList.add('hidden');
            iconMoon.classList.remove('hidden');
        }
    }

    function applySavedTheme() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            root.classList.add('dark');
        } else {
            root.classList.remove('dark');
        }
        updateThemeIcon();
    }

    if (themeToggle) {
        applySavedTheme();

        themeToggle.addEventListener('click', function() {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
            updateThemeIcon();
        });
    }

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (userMenuButton && dropdownMenu) {
        userMenuButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('#userMenuButton') && !e.target.closest('#dropdownMenu')) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (
            mobileMenu &&
            mobileMenuButton &&
            !e.target.closest('#mobileMenu') &&
            !e.target.closest('#mobileMenuButton')
        ) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
