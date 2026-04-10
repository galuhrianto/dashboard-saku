@extends('layouts.app')


@section('content')


<!-- HEADER -->
<div class="mb-6">
    <h2 class="text-3xl font-bold">{{ $state->state_name }}</h2>
    <p class="text-gray-500">
       {{ $state->icao_region }} • {{ $state->capital_city }} 
    </p>
</div>

<!-- INFO UTAMA -->
<div class="bg-white p-5 rounded-xl shadow mb-6">
    <h4 class="font-semibold mb-3">📊 Informasi Negara</h4>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
        <p><strong>Nama Negara:</strong> {{ $state->state_name }}</p>
        <p><strong>Ibu Kota:</strong> {{ $state->capital_city }}</p>
        <p><strong>Region ICAO:</strong> {{ $state->icao_region }}</p>
        <p><strong>Regional Office:</strong> {{ $state->icao_regional_office }}</p>
        <p><strong>Rep in Council:</strong> {{ $state->rep_in_council }}</p>
        <p>
            <strong>Probabilitas Vote Indonesia:</strong> 
            {{ $state->vote_probability_indonesia }}
        </p>
        <p>
            <strong>Council Part:</strong> 
            <span class="
                px-2 py-1 rounded text-white text-xs
                @if($state->council_part == 1) bg-green-500
                @elseif($state->council_part == 2) bg-blue-500
                @else bg-purple-500
                @endif
            ">
                Part {{ $state->council_part }}
            </span>
        </p>
    </div>
</div>

<!-- RELASI -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <!-- Direktur -->
    <div class="bg-white p-4 rounded-xl shadow">
        <h4 class="font-semibold mb-2">👤 Direktur</h4>
        <ul class="text-sm text-gray-700">
            @forelse($state->direktur as $d)
                <li>{{ $d->nama }} - {{ $d->jabatan }}</li>
            @empty
                <li class="text-gray-400">Tidak ada data</li>
            @endforelse
        </ul>
    </div>

    <!-- Kerjasama -->
    <div class="bg-white p-4 rounded-xl shadow">
        <h4 class="font-semibold mb-2">🤝 Kerja Sama</h4>
        <ul class="text-sm text-gray-700">
            @forelse($state->kerjasama as $k)
                <li>{{ $k->bentuk_kerjasama }}</li>
            @empty
                <li class="text-gray-400">Tidak ada data</li>
            @endforelse
        </ul>
    </div>

    <!-- Beasiswa -->
    <div class="bg-white p-4 rounded-xl shadow">
        <h4 class="font-semibold mb-2">🎓 Beasiswa</h4>
        <ul class="text-sm text-gray-700">
            @forelse($state->beasiswa as $b)
                <li>{{ $b->nama_penerima }} ({{ $b->tahun }})</li>
            @empty
                <li class="text-gray-400">Tidak ada data</li>
            @endforelse
        </ul>
    </div>

</div>



@endsection