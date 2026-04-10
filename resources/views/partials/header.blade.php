<nav class="sticky top-0 z-30 border-b border-(--border) bg-(--background)/85 backdrop-blur-xl">
  <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
    <a href="{{ route('dashboard') }}" class="text-base font-semibold tracking-tight sm:text-lg">
      One on One Diplomacy Ebook
    </a>

    @auth
      <div class="flex items-center gap-2">
        @if (auth()->user()->role_id == 1)
          <div class="relative">
            <button
              id="userMenuButton"
              type="button"
              class="inline-flex h-8 items-center rounded-(--radius) border border-(--border) bg-(--secondary) px-3 py-1.5 text-sm font-medium text-(--foreground) transition hover:border-(--primary)"
            >
              {{ auth()->user()->name }}
            </button>

            <div
              id="dropdownMenu"
              class="absolute right-0 mt-2 hidden w-44 rounded-xl border border-(--border) bg-(--card) p-1 shadow-lg"
            >
              <a
                href="{{ route('users.index') }}"
                class="block rounded-lg px-3 py-2 text-sm transition hover:bg-(--accent)"
              >
                User Management
              </a>
            </div>
          </div>
        @else
          <span class="hidden text-sm text-(--muted-foreground) sm:inline">
            {{ auth()->user()->name }}
          </span>
        @endif

        <button
          id="themeToggle"
          type="button"
          class="inline-flex h-8 w-8 items-center justify-center rounded-(--radius) border border-(--border) bg-(--secondary) text-(--secondary-foreground) transition hover:border-(--primary) hover:text-(--primary)"
          aria-label="Toggle dark mode"
        >
          <svg
            id="iconSun"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="h-4 w-4"
            aria-hidden="true"
          >
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

          <svg
            id="iconMoon"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            class="hidden h-4 w-4"
            aria-hidden="true"
          >
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9z"></path>
          </svg>
        </button>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            class="inline-flex h-8 items-center rounded-(--radius) bg-(--destructive) px-3 py-1.5 text-xs font-semibold text-white transition hover:brightness-110 sm:text-sm"
          >
            Logout
          </button>
        </form>
      </div>
    @endauth
  </div>
</nav>

<script>
  const root = document.documentElement;
  const themeToggle = document.getElementById('themeToggle');
  const iconSun = document.getElementById('iconSun');
  const iconMoon = document.getElementById('iconMoon');
  const userMenuButton = document.getElementById('userMenuButton');
  const dropdownMenu = document.getElementById('dropdownMenu');

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

    themeToggle.addEventListener('click', function () {
      root.classList.toggle('dark');
      localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
      updateThemeIcon();
    });
  }

  if (userMenuButton && dropdownMenu) {
    userMenuButton.addEventListener('click', function () {
      dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
      if (!e.target.closest('#userMenuButton') && !e.target.closest('#dropdownMenu')) {
        dropdownMenu.classList.add('hidden');
      }
    });
  }
</script>
