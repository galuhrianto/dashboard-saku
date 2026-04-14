@extends ('layouts.app')

@section('content')
    <section class="space-y-6">
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm sm:p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">Dashboard Negara ICAO</h1>
                    <p class="mt-1 text-sm text-(--muted-foreground)">Monitoring negara anggota, council part, dan status
                        DCTP</p>
                </div>
                <div class="flex items-center gap-2">
                    <div
                        class="rounded-lg border border-(--border) bg-(--secondary) px-3 py-2 text-sm text-(--secondary-foreground)">
                        Total Data:
                        <span class="font-semibold text-(--foreground)">{{ $states->total() }}</span>
                    </div>
                    <a href="{{ asset('img/' . rawurlencode('Draft Awal Aide Memoire Indonesia.pdf')) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center rounded-lg border border-(--border) bg-blue-500 px-3 py-2 text-sm font-semibold text-black transition hover:border-(--primary) dark:text-white">
                        Aide Memoire
                    </a>
                </div>
            </div>

            <form id="filterForm" method="GET" action="{{ route('dashboard') }}"
                class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama negara..."
                    class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35" />

                <select name="part" id="partFilter"
                    class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35">
                    <option value="">All Part</option>
                    <option value="1" {{ request('part') == 1 ? 'selected' : '' }}>Part I</option>
                    <option value="2" {{ request('part') == 2 ? 'selected' : '' }}>Part II</option>
                    <option value="3" {{ request('part') == 3 ? 'selected' : '' }}>Part III</option>
                </select>

                <select name="region" id="regionFilter"
                    class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35">
                    <option value="">All Region</option>
                    <option value="APAC" {{ request('region') == 'APAC' ? 'selected' : '' }}>APAC</option>
                    <option value="MID" {{ request('region') == 'MID' ? 'selected' : '' }}>MID</option>
                    <option value="EUR/NAT" {{ request('region') == 'EUR/NAT' ? 'selected' : '' }}>EUR/NAT
                    </option>
                    <option value="ESAF" {{ request('region') == 'ESAF' ? 'selected' : '' }}>ESAF</option>
                    <option value="WACAF" {{ request('region') == 'WACAF' ? 'selected' : '' }}>WACAF</option>
                    <option value="SAM" {{ request('region') == 'SAM' ? 'selected' : '' }}>SAM</option>
                    <option value="NACC" {{ request('region') == 'NACC' ? 'selected' : '' }}>NACC</option>
                </select>

                <select name="dctp" id="dctpFilter"
                    class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35">
                    <option value="">Semua Status DCTP</option>
                    <option value="Sudah Menerima" {{ request('dctp') == 'Sudah Menerima' ? 'selected' : '' }}>Sudah
                        Menerima
                    </option>
                    <option value="Penerima Potensial" {{ request('dctp') == 'Penerima Potensial' ? 'selected' : '' }}>
                        Penerima Potensial
                    </option>
                    <option value="null" {{ request('dctp') == 'null' ? 'selected' : '' }}>Belum Menerima
                    </option>
                </select>


                {{-- <select name="kerjasama"
                    class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm">

                    <option value="">Semua Kerjasama</option>

                    <option value="ASA" {{ request('kerjasama') == 'ASA' ? 'selected' : '' }}>
                        ASA
                    </option>

                    <option value="none" {{ request('kerjasama') == 'none' ? 'selected' : '' }}>
                        Belum Kerjasama
                    </option>

                </select> --}}
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-(--border) bg-(--card) shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-(--secondary) text-(--secondary-foreground)">
                        <tr>
                            <th class="px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold">Negara</th>
                            <th class="px-4 py-3 font-semibold">Ibu Kota</th>
                            <th class="px-4 py-3 font-semibold">Region</th>
                            <th class="px-4 py-3 font-semibold">Part</th>
                            <th class="px-4 py-3 font-semibold">Status Kemitraan</th>
                            <th class="px-4 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($states as $state)
                            @php
                                $partStyle =
                                    [
                                        null => 'background:#e5e7eb;color:#374151;',
                                        1 => 'background:#fae8ff;color:#a21caf;',
                                        2 => 'background:#dbeafe;color:#1d4ed8;',
                                        3 => 'background:#fef3c7;color:#b45309;',
                                    ][$state->council_part] ?? 'background:#e5e7eb;color:#374151;';

                                $dctpStyle =
                                    [
                                        'Sudah Menerima' => 'background:#d1fae5;color:#047857;',
                                        'Penerima Potensial' => 'background:#dbeafe;color:#1d4ed8;',
                                        'Prioritas Penerima Dewan ICAO' => 'background:#ede9fe;color:#6d28d9;',
                                        'Kompetitor' => 'background:#fee2e2;color:#b91c1c;',
                                        'Belum Menerima' => 'background:#f3f4f6;color:#6b7280;',
                                    ][$state->dctp_status] ?? '';
                            @endphp
                            <tr onclick="window.location='{{ route('states.show', $state->id) }}'"
                                class="border-t border-(--border)/80 transition hover:bg-(--accent)/60">
                                <td class="px-4 py-3 text-(--muted-foreground)">
                                    {{ ($states->firstItem() ?? 1) + $loop->index }}
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $state->state_name }}</td>
                                <td class="px-4 py-3 text-(--muted-foreground)">{{ $state->capital_city }}</td>
                                <td class="px-4 py-3">{{ $state->icao_region }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-semibold"
                                        style="{{ $partStyle }}">
                                        @if (is_null($state->council_part))
                                            -
                                        @else
                                            Part {{ $state->council_part }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-4 py-3 space-y-1">

                                    @php
                                        $hasDctp = $state->dctp_status;
                                        $kerjasama = $state->kerjasamas->first() ?? null;
                                    @endphp

                                    @if ($hasDctp || $kerjasama)
                                        <div class="flex flex-wrap gap-1 text-xs font-semibold">

                                            {{-- DCTP --}}
                                            @if ($hasDctp)
                                                <span class="px-2 py-0.5 rounded-full" style="{{ $dctpStyle }}">
                                                    DCTP ({{ $state->dctp_status }})
                                                </span>
                                            @endif

                                            {{-- Kerjasama --}}
                                            @if ($kerjasama)
                                                <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">
                                                    {{ $kerjasama->bentuk_kerjasama }}
                                                </span>
                                            @endif

                                        </div>
                                    @else
                                        <span class="text-xs text-(--muted-foreground)">-</span>
                                    @endif

                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('states.show', $state->id) }}"
                                        class="inline-flex items-center rounded-(--radius) border border-(--border) bg-(--background) px-3 py-1.5 text-xs font-semibold transition hover:border-(--primary) hover:text-(--primary)">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-(--muted-foreground)">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

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
    </section>

@endsection

@section('scripts')
    <script>
        let timeout = null;

        // Search auto submit dengan debounce.
        document.getElementById('searchInput').addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });

        ['partFilter', 'regionFilter', 'dctpFilter'].forEach((id) => {
            document.getElementById(id).addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
@endsection
