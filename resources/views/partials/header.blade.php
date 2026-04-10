<nav class="bg-gray-900 text-white px-6 py-4 shadow flex justify-between items-center">
    
    <!-- Title -->
    <a href="{{ route('dashboard') }}" class="text-lg font-semibold hover:text-gray-300">
        One on One Diplomacy Ebook
    </a>

    <!-- Right Side (optional: user / logout) -->
    @auth
<div class="flex items-center gap-3 relative">

    @if(auth()->user()->role_id == 1)
      
        <div class="relative">
            <button onclick="toggleDropdown()" 
                class="text-sm hover:underline focus:outline-none">
                {{ auth()->user()->name }}
            </button>

            <!-- DROPDOWN -->
            <div id="dropdownMenu" 
                class="hidden absolute right-0 mt-2 w-40 bg-white text-black rounded shadow">

                <a href="{{ route('users.index') }}" 
                   class="block px-4 py-2 hover:bg-gray-100">
                    User Management
                </a>

            </div>
        </div>
    @else
        
        <span class="text-sm">
            {{ auth()->user()->name }}
        </span>
    @endif

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="bg-red-500 px-3 py-1 rounded text-sm hover:bg-red-600">
            Logout
        </button>
    </form>

</div>
@endauth

</nav>

<script>
function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.classList.toggle('hidden');
}

// optional: klik luar nutup dropdown
document.addEventListener('click', function(e) {
    const button = e.target.closest('button');
    const menu = document.getElementById('dropdownMenu');

    if (!button && !e.target.closest('#dropdownMenu')) {
        menu.classList.add('hidden');
    }
});
</script>