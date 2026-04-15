@extends('layouts.admin.app')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <!-- TOTAL NEGARA -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-4 shadow-sm">
            <p class="text-sm text-(--muted-foreground)">Total Negara</p>
            <h2 class="text-2xl text-(--foreground) font-semibold mt-1">{{ $totalStates }}</h2>
        </div>

        <!-- TOTAL KERJA SAMA -->
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
                        <th class="px-4 py-3 font-semibold">Status Kemitraan</th>
                        <th class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($states as $state)
                        <tr class="border-t border-(--border)/80 hover:bg-(--accent)/60"
                            onclick="window.location='{{ route('admin.states.show', $state) }}'">

                            <!-- NO -->
                            <td class="px-4 py-3 text-(--muted-foreground)">
                                {{ ($states->firstItem() ?? 1) + $loop->index }}
                            </td>

                            <!-- NEGARA -->
                            <td class="px-4 py-3 text-(--foreground) font-medium">
                                {{ $state->state_name }}
                            </td>

                            <!-- REGION -->
                            <td class="px-4 py-3 text-(--foreground)">
                                {{ $state->icao_region }}
                            </td>

                            <!-- STATUS KEMITRAAN -->
                            <td class="px-4 py-3 space-y-1">

                                @php
                                    $kerjasamas = $state->kerjasamas;
                                @endphp

                                @if ($kerjasamas->isNotEmpty())
                                    <div class="flex flex-wrap gap-1 text-xs font-semibold">

                                        @foreach ($kerjasamas as $item)
                                            @php
                                                $style = match (true) {
                                                    // DCTP
                                                    $item->bentuk_kerjasama === 'DCTP' &&
                                                        $item->status === 'Sudah Menerima'
                                                        => 'background:#d1fae5;color:#047857;',

                                                    $item->bentuk_kerjasama === 'DCTP' &&
                                                        $item->status === 'Penerima Potensial'
                                                        => 'background:#dbeafe;color:#1d4ed8;',

                                                    $item->bentuk_kerjasama === 'DCTP' && $item->status === 'Kompetitor'
                                                        => 'background:#fee2e2;color:#b91c1c;',
                                                    // ASA
                                                    $item->bentuk_kerjasama === 'ASA'
                                                        => 'background:#e0f2fe;color:#0369a1;',
                                                    // default
                                                    default => 'background:#f3f4f6;color:#6b7280;',
                                                };
                                            @endphp

                                            <span class="px-2 py-0.5 rounded-full" style="{{ $style }}">
                                                {{ $item->bentuk_kerjasama }}
                                                @if ($item->status)
                                                    ({{ $item->status }})
                                                @endif
                                            </span>
                                        @endforeach

                                    </div>
                                @else
                                    <span class="text-(--muted-foreground)">-</span>
                                @endif

                            </td>

                            <!-- AKSI -->
                            <td class="px-4 py-3 flex gap-3 items-center">

                                <!-- EDIT -->
                                <a href="{{ route('admin.states.edit', $state) }}"
                                    class="text-blue-600 hover:text-blue-800 transition" title="Edit">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">edit-pencil</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.363 5.652l1.48-1.48a2 2 0 0 1 2.829 0l1.414 1.414a2 2 0 0 1 0 2.828l-1.48 1.48m-4.243-4.242l-9.616 9.615a2 2 0 0 0-.578 1.238l-.242 2.74a1 1 0 0 0 1.084 1.085l2.74-.242a2 2 0 0 0 1.24-.578l9.615-9.616m-4.243-4.242l4.243 4.242"/></svg>

                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('admin.states.destroy', $state) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:text-red-800 transition"
                                        title="Hapus">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">trash</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m20 9l-1.995 11.346A2 2 0 0 1 16.035 22h-8.07a2 2 0 0 1-1.97-1.654L4 9m17-3h-5.625M3 6h5.625m0 0V4a2 2 0 0 1 2-2h2.75a2 2 0 0 1 2 2v2m-6.75 0h6.75"/></svg>

                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-(--muted-foreground)">
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
                @if ($states->total() > 0)
                    Showing {{ $states->firstItem() }} to {{ $states->lastItem() }} of {{ $states->total() }}
                @else
                    Showing 0 of 0
                @endif
            </p>
            {{ $states->onEachSide(1)->links() }}
        </div>


    </div>
@endsection
