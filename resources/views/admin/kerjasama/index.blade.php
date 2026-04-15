@extends('layouts.admin.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-lg font-semibold text-(--foreground)">Manajemen Kerjasama</h1>

        <a href="{{ route('admin.kerjasama.create') }}"
            class="rounded-lg bg-(--primary) px-4 py-2 text-sm text-white hover:opacity-90">
            + Tambah Kerjasama </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <div class="rounded-2xl border border-(--border) bg-(--card) p-4 shadow-sm">
            <p class="text-sm text-(--muted-foreground)">Total Kerjasama</p>
            <h2 class="text-2xl text-(--foreground) font-semibold mt-1">
                {{ $kerjasamas->total() }}
            </h2>
        </div>

    </div>

    <div class="overflow-hidden rounded-2xl border border-(--border) bg-(--card) shadow-sm">

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">


                <thead class="bg-(--secondary) text-(--secondary-foreground)">
                    <tr>
                        <th class="px-4 py-3 font-semibold">No</th>
                        <th class="px-4 py-3 font-semibold">Negara</th>
                        <th class="px-4 py-3 font-semibold">Region</th>
                        <th class="px-4 py-3 font-semibold">Bentuk</th>
                        <th class="px-4 py-3 font-semibold">Status</th>
                        <th class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($kerjasamas as $item)
                        @php
                            $style = match (true) {
                                // DCTP
                                $item->bentuk_kerjasama === 'DCTP' && $item->status === 'Sudah Menerima'
                                    => 'background:#d1fae5;color:#047857;',

                                $item->bentuk_kerjasama === 'DCTP' && $item->status === 'Penerima Potensial'
                                    => 'background:#dbeafe;color:#1d4ed8;',

                                $item->bentuk_kerjasama === 'DCTP' && $item->status === 'Kompetitor'
                                    => 'background:#fee2e2;color:#b91c1c;',
                                // ASA
                                $item->bentuk_kerjasama === 'ASA' => 'background:#e0f2fe;color:#0369a1;',
                                // default
                                default => 'background:#f3f4f6;color:#6b7280;',
                            };
                        @endphp

                        <tr class="border-t border-(--border)/80 hover:bg-(--accent)/60">

                            <!-- NO -->
                            <td class="px-4 py-3 text-(--muted-foreground)">
                                {{ ($kerjasamas->firstItem() ?? 1) + $loop->index }}
                            </td>

                            <!-- NEGARA -->
                            <td class="px-4 py-3 text-(--foreground) font-medium">
                                {{ $item->state->state_name ?? '-' }}
                            </td>

                            <!-- REGION -->
                            <td class="px-4 py-3 text-(--foreground)">
                                {{ $item->state->icao_region ?? '-' }}
                            </td>

                            <!-- BENTUK -->
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded-full" style="{{ $style }}">
                                    {{ $item->bentuk_kerjasama }}
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td class="px-4 py-3 text-(--foreground)">
                                {{ $item->status ?? '-' }}
                            </td>

                            <!-- AKSI -->
                            <td class="px-4 py-3 flex gap-2">

                                <a href="{{ route('admin.kerjasama.edit', $item) }}"
                                    class="text-blue-600 hover:underline text-xs">
                                    Edit
                                </a>

                                <form action="{{ route('admin.kerjasama.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:underline text-xs">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-(--muted-foreground)">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>


        </div>

        <!-- PAGINATION -->

        <div class="flex items-center justify-between gap-3 border-t border-(--border) px-4 py-3">
            <p class="text-sm text-(--muted-foreground)">
                @if ($kerjasamas->total() > 0)
                    Showing {{ $kerjasamas->firstItem() }} to {{ $kerjasamas->lastItem() }} of {{ $kerjasamas->total() }}
                @else
                    Showing 0 of 0
                @endif
            </p>
            {{ $kerjasamas->onEachSide(1)->links() }}
        </div>

    </div>
@endsection
