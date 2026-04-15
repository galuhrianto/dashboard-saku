<div class="relative w-full {{ $isRoot ? 'mb-2 last:mb-0' : 'mt-3' }}">

    {{-- Garis horizontal ke node (hanya untuk anak) --}}
    @if (!$isRoot)
        <div class="absolute -left-[28px] top-[27px] w-[28px] h-px bg-gray-300 dark:bg-gray-700"></div>
    @endif

    {{-- 
        INNER NODE CARD
        Light Mode: bg-gray-50 (Sedikit abu cerah agar pop-up di atas background putih)
        Dark Mode : dark:bg-gray-800
    --}}
    <div
        class="group relative flex items-center justify-between p-3 sm:p-4 w-full
                bg-gray-50 dark:bg-gray-800
                border border-gray-200 dark:border-gray-700
                rounded-xl z-10
                hover:bg-white dark:hover:bg-gray-700
                hover:border-blue-400 dark:hover:border-blue-500
                hover:shadow-md
                transition-all duration-150">

        {{-- Info anggota --}}
        <div class="flex items-center gap-3 sm:gap-4 overflow-hidden min-w-0">
            @if ($node->photo && Storage::disk('public')->exists($node->photo))
                <img src="{{ asset('storage/' . $node->photo) }}" alt="{{ $node->name }}"
                    class="w-[54px] h-[54px] rounded-full object-cover
                           border border-gray-300 dark:border-gray-600
                           shadow-sm shrink-0">
            @else
                <div
                    class="w-[54px] h-[54px] rounded-full shrink-0
                            bg-blue-100 dark:bg-blue-900/50
                            text-blue-700 dark:text-blue-300
                            flex items-center justify-center
                            font-bold text-xl
                            border border-blue-200 dark:border-gray-600 shadow-sm">
                    {{ strtoupper(substr($node->name, 0, 1)) }}
                </div>
            @endif

            <div class="flex flex-col min-w-0">
                <h3 class="text-sm sm:text-base font-bold text-gray-900 dark:text-white truncate">
                    {{ $node->name }}
                </h3>
                <p
                    class="text-xs sm:text-sm font-semibold text-blue-600 dark:text-blue-400 mt-0.5 truncate uppercase tracking-wide">
                    {{ $node->position }}
                </p>
            </div>
        </div>

        {{-- Tombol aksi --}}
        <div
            class="flex items-center gap-1 sm:gap-2 ml-2 shrink-0 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity duration-200">
            <a href="{{ route('admin.head_offices.edit', $node->id) }}"
                class="p-2 rounded-lg transition-colors focus:outline-none
                       text-gray-500 dark:text-gray-400
                       hover:text-blue-600 dark:hover:text-blue-400
                       hover:bg-blue-100 dark:hover:bg-gray-600"
                title="Edit Data">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
            </a>

            <form action="{{ route('admin.head_offices.destroy', $node->id) }}" method="POST" class="m-0 flex"
                onsubmit="return confirm('Yakin ingin menghapus {!! addslashes($node->name) !!}?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="p-2 rounded-lg transition-colors focus:outline-none
                           text-gray-500 dark:text-gray-400
                           hover:text-red-600 dark:hover:text-red-400
                           hover:bg-red-100 dark:hover:bg-gray-600"
                    title="Hapus Data">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Kontainer anak dengan garis vertikal --}}
    @if ($node->children->count() > 0)
        <div class="children-wrapper ml-[22px] pl-[28px] border-l border-gray-300 dark:border-gray-700 relative">
            @foreach ($node->children as $child)
                @include('admin.head_offices.partials.node', ['node' => $child, 'isRoot' => false])
            @endforeach
        </div>
    @endif
</div>
