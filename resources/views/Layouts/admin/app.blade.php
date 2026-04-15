<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    {{-- SCRIPT PENGATUR TEMA (BACA LOCAL STORAGE) --}}
    <script>
        // Cek local storage. Jika 'dark', atau jika kosong tapi OS-nya dark, maka tambah class 'dark'
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite ('resources/css/app.css')
</head>

<body class="bg-(--background) text-gray-900 dark:text-gray-100 transition-colors duration-200">

    <div class="flex">

        {{-- SIDEBAR --}}
        @include('layouts.admin.sidebar')

        <div id="overlay" class="fixed inset-0 bg-gray-900/50 hidden z-40 md:hidden">
        </div>

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col min-h-screen">

            {{-- HEADER --}}
            @include('layouts.admin.header')

            {{-- CONTENT --}}
            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            if (!toggleBtn || !sidebar || !overlay) return;

            toggleBtn.addEventListener('click', () => {
                // MOBILE
                if (window.innerWidth < 768) {
                    const isHidden = sidebar.classList.contains('-translate-x-full');

                    if (isHidden) {
                        sidebar.classList.remove('-translate-x-full');
                        overlay.classList.remove('hidden');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                    }
                }
                // DESKTOP
                else {
                    sidebar.classList.toggle('hidden');
                }
            });

            // CLICK OUTSIDE (mobile only)
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
