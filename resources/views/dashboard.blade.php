@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Dashboard</h2>

<form id="filterForm" method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-3 mb-4">

    <!-- SEARCH -->
    <input 
        type="text" 
        name="search"
        id="searchInput"
        value="{{ request('search') }}"
        placeholder="Cari negara / direktur..."
        class="w-1/3 px-4 py-2 border rounded-lg"
    >

    <!-- PART -->
    <select name="part" id="partFilter" class="px-4 py-2 border rounded-lg">
        <option value="">All Part</option>
        <option value="1" {{ request('part') == 1 ? 'selected' : '' }}>Part I</option>
        <option value="2" {{ request('part') == 2 ? 'selected' : '' }}>Part II</option>
        <option value="3" {{ request('part') == 3 ? 'selected' : '' }}>Part III</option>
    </select>

    <!-- REGION -->
    <select name="region" id="regionFilter" class="px-4 py-2 border rounded-lg">
    <option value="">All Region</option>
    <option value="APAC" {{ request('region') == 'APAC' ? 'selected' : '' }}>APAC</option>
    <option value="MID" {{ request('region') == 'MID' ? 'selected' : '' }}>MID</option>
    <option value="EUR/NAT" {{ request('region') == 'EUR/NAT' ? 'selected' : '' }}>EUR/NAT</option>
    <option value="ESAF" {{ request('region') == 'ESAF' ? 'selected' : '' }}>ESAF</option>
    <option value="WACAF" {{ request('region') == 'WACAF' ? 'selected' : '' }}>WACAF</option>
    <option value="SAM" {{ request('region') == 'SAM' ? 'selected' : '' }}>SAM</option>
    <option value="NACC" {{ request('region') == 'NACC' ? 'selected' : '' }}>NACC</option>
</select>

    <!-- DCTP -->
    <select name="dctp" id="dctpFilter" class="px-4 py-2 border rounded-lg">
        <option value="">All Status</option>
        <option value="Belum Menerima" {{ request('dctp_enum') == 'Belum Menerima' ? 'selected' : '' }}>Belum Menerima</option>
        <option value="Sudah Menerima" {{ request('dctp_enum') == 'Sudah Menerima' ? 'selected' : '' }}>Sudah Menerima</option>
        <option value="Potensial Menerima" {{ request('dctp_enum') == 'Potensial Menerima' ? 'selected' : '' }}>Potensial Menerima</option>
    </select>

</form>

<div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Negara</th>
                <th class="p-3">Ibu Kota</th>
                <th class="p-3">Region</th>
                <th class="p-3">Part</th>
                <th class="p-3">DCTP Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($states as $state)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3 font-medium">{{ $state->state_name }}</td>
                <td class="p-3">{{ $state->capital_city }}</td>
                <td class="p-3">{{ $state->icao_region }}</td>
                <td class="p-3">
                    <span class="
                        px-2 py-1 text-sm rounded-full text-white
                        @if(is_null($state->council_part)) bg-gray-400
                        @elseif($state->council_part == 1) bg-pink-500
                        @elseif($state->council_part == 2) bg-blue-500
                        @elseif($state->council_part == 3) bg-yellow-500 text-black
                        @endif
                    ">
                        @if(is_null($state->council_part))
                            -
                        @else
                            Part {{ $state->council_part }}
                        @endif
                    </span>
                </td>
                <td class="p-3">
                    <span class="
                        px-2 py-1 text-sm rounded-full text-white
                        @if($state->dctp_enum == 'Belum Menerima') bg-red-500
                        @elseif($state->dctp_enum == 'Sudah Menerima') bg-green-500
                        @elseif($state->dctp_enum == 'Potensial Menerima') bg-yellow-500 text-black
                        @else bg-gray-400
                        @endif
                    ">
                        {{ $state->dctp_enum ?? '-' }}
                    </span>
                </td>

                <td class="p-3">
                    <a href="{{ route('states.show', $state->id) }}" 
                       class="bg-gray-900 text-white px-3 py-1 rounded-lg hover:bg-gray-700">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-400">
                    Data tidak ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection


@section('scripts')
<script>
let timeout = null;

// 🔍 SEARCH (debounce)
document.getElementById('searchInput').addEventListener('keyup', function () {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 500);
});

// 🎛️ SEMUA FILTER AUTO SUBMIT
['partFilter', 'regionFilter', 'dctpFilter'].forEach(id => {
    document.getElementById(id).addEventListener('change', function () {
        document.getElementById('filterForm').submit();
    });
});

</script>
@endsection