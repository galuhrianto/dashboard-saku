@extends('layouts.admin.app')

@section('content')

<section class="space-y-6 text-(--foreground)">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-semibold text-(--foreground)">
            Tambah State
        </h1>
    </div>

    <form action="{{ route('admin.kerjasama.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- ================= INFORMASI DASAR ================= -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
            <h2 class="text-sm font-semibold text-(--foreground)">Informasi Dasar</h2>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="state_name"
                    value="{{ old('state_name') }}"
                    placeholder="Nama Negara"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="country_code"
                    value="{{ old('country_code') }}"
                    placeholder="Kode Negara"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="capital_city"
                    value="{{ old('capital_city') }}"
                    placeholder="Ibu Kota"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="icao_region"
                    value="{{ old('icao_region') }}"
                    placeholder="Region ICAO"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="icao_regional_office"
                    value="{{ old('icao_regional_office') }}"
                    placeholder="Regional Office"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="leader"
                    value="{{ old('leader') }}"
                    placeholder="Leader"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

            </div>
        </div>

        <!-- ================= ICAO ================= -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
            <h2 class="text-sm font-semibold text-(--foreground)">ICAO Info</h2>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="rep_in_council"
                    value="{{ old('rep_in_council') }}"
                    placeholder="Representative in Council"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="vote_probability_indonesia"
                    value="{{ old('vote_probability_indonesia') }}"
                    placeholder="Vote Probability Indonesia"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="number" name="council_part"
                    value="{{ old('council_part') }}"
                    placeholder="Council Part"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="posisi_2016"
                    value="{{ old('posisi_2016') }}"
                    placeholder="Posisi 2016"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="posisi_2013"
                    value="{{ old('posisi_2013') }}"
                    placeholder="Posisi 2013"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

            </div>
        </div>

        <!-- ================= DETAIL ================= -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
            <h2 class="text-sm font-semibold text-(--foreground)">Detail Negara</h2>

            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="dialing_code"
                    value="{{ old('dialing_code') }}"
                    placeholder="Dialing Code"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="currency"
                    value="{{ old('currency') }}"
                    placeholder="Currency"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="population"
                    value="{{ old('population') }}"
                    placeholder="Population"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="official_languages"
                    value="{{ old('official_languages') }}"
                    placeholder="Official Languages"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

                <input type="text" name="university"
                    value="{{ old('university') }}"
                    placeholder="University"
                    class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">

            </div>
        </div>

        <!-- ================= TEXT ================= -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
            <h2 class="text-sm font-semibold text-(--foreground)">Deskripsi</h2>

            <textarea name="informasi_umum"
                placeholder="Informasi Umum"
                class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">{{ old('informasi_umum') }}</textarea>

            <textarea name="deskripsi"
                placeholder="Deskripsi"
                class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">{{ old('deskripsi') }}</textarea>

            <textarea name="points_of_interest"
                placeholder="Points of Interest"
                class="w-full rounded-lg border border-(--border) bg-(--secondary)/40 px-3 py-2 text-sm">{{ old('points_of_interest') }}</textarea>

        </div>

        <!-- SUBMIT -->
        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}"
               class="bg-(--destructive) text-white px-5 py-2 rounded-lg text-sm hover:opacity-90 transition mr-4">
                Batal
            </a>

            <button class="bg-(--primary) text-white px-5 py-2 rounded-lg text-sm hover:opacity-90 transition">
                Simpan
            </button>
        </div>

    </form>

</section>

@endsection