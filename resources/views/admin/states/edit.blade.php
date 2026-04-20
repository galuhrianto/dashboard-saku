@extends('layouts.admin.app')

@section('content')
    <section class="space-y-6 text-(--foreground)">

        <!-- HEADER -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-(--foreground)">
                Edit State
            </h1>


        </div>

        <form action="{{ route('admin.states.update', $state) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- ================= INFORMASI DASAR ================= -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
                <h2 class="text-sm font-semibold">Informasi Dasar</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- STATE NAME -->
                    <div>
                        <label class="text-xs font-semibold">
                            Nama Negara <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="state_name" value="{{ old('state_name', $state->state_name) }}"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm
                    @error('state_name') border-red-500 @else border-(--border) @enderror">

                        @error('state_name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- COUNTRY CODE -->
                    <div>
                        <label class="text-xs">Kode Negara (2 huruf)</label>

                        <input type="text" name="country_code" value="{{ old('country_code', $state->country_code) }}"
                            maxlength="2" oninput="this.value = this.value.toUpperCase()"
                            class="mt-1 w-full rounded-lg border px-3 py-2 text-sm
                    @error('country_code') border-red-500 @else border-(--border) @enderror">

                        @error('country_code')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-xs">Ibu Kota</label>
                        <input type="text" name="capital_city" value="{{ old('capital_city', $state->capital_city) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Region ICAO</label>
                        <input type="text" name="icao_region" value="{{ old('icao_region', $state->icao_region) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Regional Office</label>
                        <input type="text" name="icao_regional_office"
                            value="{{ old('icao_regional_office', $state->icao_regional_office) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Leader</label>
                        <input type="text" name="leader" value="{{ old('leader', $state->leader) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                </div>
            </div>

            <!-- ================= ICAO ================= -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
                <h2 class="text-sm font-semibold ">ICAO Info</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-xs">Representative in Council</label>
                        <input type="text" name="rep_in_council"
                            value="{{ old('rep_in_council', $state->rep_in_council) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Vote Probability Indonesia</label>
                        <input type="text" name="vote_probability_indonesia"
                            value="{{ old('vote_probability_indonesia', $state->vote_probability_indonesia) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Council Part</label>
                        <input type="number" name="council_part" value="{{ old('council_part', $state->council_part) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Posisi 2016</label>
                        <input type="text" name="posisi_2016" value="{{ old('posisi_2016', $state->posisi_2016) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Posisi 2013</label>
                        <input type="text" name="posisi_2013" value="{{ old('posisi_2013', $state->posisi_2013) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                </div>
            </div>

            <!-- ================= DETAIL ================= -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
                <h2 class="text-sm font-semibold ">Detail Negara</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-xs">Dialing Code</label>
                        <input type="text" name="dialing_code" value="{{ old('dialing_code', $state->dialing_code) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Currency</label>
                        <input type="text" name="currency" value="{{ old('currency', $state->currency) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Population</label>
                        <input type="text" name="population" value="{{ old('population', $state->population) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">Official Languages</label>
                        <input type="text" name="official_languages"
                            value="{{ old('official_languages', $state->official_languages) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="text-xs">University</label>
                        <input type="text" name="university" value="{{ old('university', $state->university) }}"
                            class="mt-1 w-full rounded-lg border border-(--border) px-3 py-2 text-sm">
                    </div>

                </div>
            </div>

            <!-- ================= TEXT ================= -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm space-y-4">
                <h2 class="text-sm font-semibold ">Deskripsi</h2>

                <textarea name="informasi_umum" class="w-full rounded-lg border border-(--border) px-3 py-2 text-sm">{{ old('informasi_umum', $state->informasi_umum) }}</textarea>

                <textarea name="deskripsi" class="w-full rounded-lg border border-(--border) px-3 py-2 text-sm">{{ old('deskripsi', $state->deskripsi) }}</textarea>

                <textarea name="points_of_interest" class="w-full rounded-lg border border-(--border) px-3 py-2 text-sm">{{ old('points_of_interest', $state->points_of_interest) }}</textarea>
            </div>

            <!-- SUBMIT -->
            <div class="flex justify-end gap-2">

                <a href="{{ route('admin.dashboard') }}"
                    class="px-5 py-2 rounded-lg text-sm border border-(--border) hover:bg-(--secondary)">
                    Batal
                </a>

                <button class="bg-(--primary) text-white px-5 py-2 rounded-lg text-sm hover:brightness-105">
                    Update
                </button>

            </div>

        </form>

    </section>
@endsection
