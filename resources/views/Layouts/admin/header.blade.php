<nav class="sticky top-0 z-30 border-b border-(--border) bg-(--background)/85 backdrop-blur-xl">
    <div class="mx-auto flex w-full items-center justify-between gap-4 px-4 py-4 sm:px-6">

        <!-- LEFT -->
        <div class="flex items-center gap-4">

            <!-- HAMBURGER -->
            <button id="toggleSidebar" class="text-(--muted-foreground) text-xl hover:text-(--foreground) transition">
                ☰
            </button>

            <h1 class="font-semibold text-lg text-(--foreground) tracking-tight">
                Dashboard Admin
            </h1>

        </div>

        <!-- RIGHT -->
        <div class="flex items-center gap-2">

    <!-- THEME TOGGLE -->
    <button id="themeToggle" type="button"
        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-(--border) bg-(--secondary) text-(--secondary-foreground) transition hover:border-(--primary) hover:text-(--primary)">

        <!-- SUN -->
        <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2"
            class="h-4 w-4">
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

        <!-- MOON -->
        <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2"
            class="hidden h-4 w-4">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9z"></path>
        </svg>

    </button>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            class="inline-flex items-center rounded-lg border border-red-500/30 px-3 py-1.5 text-sm font-medium text-red-500 transition hover:bg-red-500/10">
            Logout
        </button>
    </form>

</div>

    </div>

</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const root = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const iconSun = document.getElementById('iconSun');
        const iconMoon = document.getElementById('iconMoon');

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
            }

            updateThemeIcon();
        }

        if (themeToggle) {
            applySavedTheme();

            themeToggle.addEventListener('click', function() {
                root.classList.toggle('dark');

                localStorage.setItem(
                    'theme',
                    root.classList.contains('dark') ? 'dark' : 'light'
                );

                updateThemeIcon();
            });
        }

    });
</script>
