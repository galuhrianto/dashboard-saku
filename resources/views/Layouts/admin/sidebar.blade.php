<aside id="sidebar"
    class="bg-(--card) border-r border-(--border)
         min-h-screen w-64 p-5
         fixed top-0 left-0 md:relative
         z-50
         -translate-x-full md:translate-x-0
         transition-transform duration-300">
    <!-- TITLE -->
    <div class="mb-8">

        <a href="{{ route('dashboard') }}">

            <h2 class="text-(--foreground) font-semibold tracking-tight">
                One on One Diplomacy Ebook
            </h2>
        </a>
    </div>

    <!-- MENU -->
    <nav class="space-y-1 text-sm">

        <!-- DASHBOARD -->
        <a href="/admin/dashboard"
            class="block px-3 py-2 rounded-lg font-medium text-(--foreground)
              hover:bg-(--secondary) transition">
            Dashboard
        </a>

        <!-- NEGARA -->
        <a href="#"
            class="block px-3 py-2 rounded-lg text-(--muted-foreground)
              hover:bg-(--secondary) hover:text-(--foreground) transition disabled">
            Manajemen Negara
        </a>

        <!-- KERJASAMA -->
        <a href="/admin/kerjasama"
            class="block px-3 py-2 rounded-lg text-(--muted-foreground)
              hover:bg-(--secondary) hover:text-(--foreground) transition">
            Kerjasama
        </a>


        <a href="{{ route('admin.users.index') }}"
            class="block px-3 py-2 rounded-lg text-(--muted-foreground)
              hover:bg-(--secondary) hover:text-(--foreground) transition">
            User Management
        </a>

        <a href="{{ route('admin.media.index') }}"
            class="block px-3 py-2 rounded-lg text-(--muted-foreground)
              hover:bg-(--secondary) hover:text-(--foreground) transition">
            Media
        </a>

        <a href="{{ route('admin.head_offices.index') }}"
            class="block px-3 py-2 rounded-lg text-(--muted-foreground)
              hover:bg-(--secondary) hover:text-(--foreground) transition">
            Head Office
        </a>


    </nav>

</aside>
