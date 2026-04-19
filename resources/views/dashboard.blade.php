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
                    <a href="{{ asset('storage/' . $aidememoire->file_path) }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center rounded-lg border border-(--border) bg-blue-500 px-3 py-2 text-sm font-semibold text-white transition hover:border-(--primary) dark:text-white">
                        Aide Memoire
                    </a>
                </div>
            </div>

            <form id="filterForm" method="GET" action="{{ route('dashboard') }}"
                class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama negara/direktur..."
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

                <select id="kemitraanSelect"
                    class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm">
                    <option value="">Pilih Kemitraan</option>

                    @foreach ($kemitraanList as $item)
                        <option value="{{ $item['value'] }}">
                            {{ $item['label'] }}
                        </option>
                    @endforeach

                    <option value="none">Belum Ada</option>
                </select>

                <div id="chipsContainer" class="flex flex-wrap gap-2 mt-3"></div>


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
                            <th class="px-4 py-3 font-semibold">
                                <a href="{{ request()->fullUrlWithQuery([
                                    'sort' => request('sort') === 'kerjasama' ? null : 'kerjasama',
                                ]) }}"
                                    class="flex items-center gap-1">

                                    No

                                    @if (request('sort') === 'kerjasama')
                                        <span class="text-xs">▲</span>
                                    @endif
                                </a>
                            </th>
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
                            @endphp
                            <tr onclick="window.location='{{ route('states.show', $state->id) }}'"
                                class="border-t border-(--border)/80 transition hover:bg-(--accent)/60">

                                @php
                                    $count = $state->kerjasamas->count();

                                    $bg = '';
                                    $text = '';

                                    if ($count >= 3) {
                                        $bg = 'bg-green-100';
                                        $text = 'text-green-600';
                                    } elseif ($count == 2) {
                                        $bg = 'bg-blue-100';
                                        $text = 'text-blue-600';
                                    }
                                @endphp

                                <td class="px-4 py-3 text-(--muted-foreground)">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 text-xs font-semibold rounded-md {{ $bg }} {{ $text }}">
                                        {{ ($states->firstItem() ?? 1) + $loop->index }}
                                    </span>
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
                                        $kerjasamas = $state->kerjasamas;
                                    @endphp

                                    @if ($kerjasamas->isNotEmpty())
                                        <div class="flex flex-wrap gap-1 text-xs font-semibold">

                                            @foreach ($kerjasamas as $item)
                                                @php
                                                    $style = match ($item->status_penerimaan) {
                                                        'Sudah Menerima' => 'background:#d1fae5;color:#047857;',
                                                        'Penerima Potensial' => 'background:#dbeafe;color:#1d4ed8;',
                                                        'Prioritas Penerima Dewan ICAO'
                                                            => 'background:#ede9fe;color:#6d28d9;',
                                                        'Kompetitor' => 'background:#fee2e2;color:#b91c1c;',
                                                        default => 'background:#f3f4f6;color:#6b7280;',
                                                    };
                                                @endphp

                                                <span class="px-2 py-0.5 rounded-full" style="{{ $style }}">
                                                    {{ $item->bentuk_kerjasama }}
                                                    @if ($item->status_penerimaan)
                                                        ({{ $item->status_penerimaan }})
                                                    @endif
                                                </span>
                                            @endforeach

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
        const form = document.getElementById('filterForm');

        // 🔍 SEARCH
        document.getElementById('searchInput')?.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                submitForm();
            }, 500);
        });

        // 🔽 FILTER SELECT
        ['partFilter', 'regionFilter', 'dctpFilter'].forEach((id) => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('change', submitForm);
            }
        });

        // =======================
        // 🔥 KEMITRAAN (CHIPS)
        // =======================

        const select = document.getElementById('kemitraanSelect');
        const container = document.getElementById('chipsContainer');

        let selected = @json(request('kemitraan', []));
        if (!Array.isArray(selected)) {
            selected = [selected];
        }

        renderChips();

        select.addEventListener('change', function() {
            const value = this.value;

            if (!value) return;

            if (!selected.includes(value)) {
                selected.push(value);
            }

            this.value = '';
            submitForm();
        });

        function renderChips() {
            container.innerHTML = '';

            selected.forEach((value, index) => {

                const chip = document.createElement('div');
                chip.className =
                    "flex items-center gap-1 px-3 py-1.5 text-xs rounded-full bg-blue-500 text-white";

                chip.innerHTML = `
            ${getLabel(value)}
            <button type="button" class="ml-1 text-white/70 hover:text-white">×</button>
        `;

                // hidden input
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'kemitraan[]';
                input.value = value;

                chip.appendChild(input);

                chip.querySelector('button').addEventListener('click', function() {
                    selected.splice(index, 1);
                    submitForm();
                });

                container.appendChild(chip);
            });
        }

        function getLabel(value) {
            const option = [...select.options].find(o => o.value === value);
            return option ? option.text : value;
        }


        function submitForm() {
            renderChips();
            form.submit();
        }
    </script>
@endsection
