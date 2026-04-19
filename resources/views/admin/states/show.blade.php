@extends('layouts.admin.app')

@section('content')
    <section class="space-y-6 text-(--foreground)">

        <!-- HEADER -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-(--foreground)">
                {{ $state->state_name }}
            </h1>

            <a href="{{ route('admin.states.edit', $state) }}" class="text-sm px-4 py-2 rounded-lg bg-(--primary) text-white">
                Edit State
            </a>
        </div>

        <!-- INFO SINGKAT -->
        <div class="rounded-xl border border-(--border) bg-(--card) p-4">
            <p class="text-sm"><b>Region:</b> {{ $state->icao_region }}</p>
            <p class="text-sm"><b>Capital:</b> {{ $state->capital_city ?? '-' }}</p>
            <p class="text-sm"><b>Leader:</b> {{ $state->leader ?? '-' }}</p>
        </div>

        <!-- ================= DIREKTUR ================= -->
        @php
            $dir = $state->direktur;
        @endphp

        <div class="p-6">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                <!-- FOTO -->
                <div
                    class="flex flex-col items-center justify-center rounded-xl border border-dashed border-(--border) bg-(--secondary)/30 p-5 text-center overflow-hidden">

                    @if ($state->direktur && $state->direktur->photo)
                        <img src="{{ asset('storage/' . $state->direktur->photo) }}"
                            class="w-full max-w-full object-cover rounded-lg">
                    @else
                        <div
                            class="flex h-20 w-20 items-center justify-center rounded-full border border-(--border) bg-(--secondary) text-sm font-bold text-(--muted-foreground)">
                            FOTO
                        </div>

                        <p class="mt-3 text-xs font-medium text-(--muted-foreground)">
                            Foto belum tersedia
                        </p>
                    @endif

                </div>

                <!-- FORM + INFO -->
                <form action="{{ route('admin.states.direktur.store', $state) }}" method="POST"
                    enctype="multipart/form-data"
                    class="rounded-xl border border-(--border) bg-(--secondary)/20 p-4 md:col-span-2 space-y-3">
                    @csrf

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                        <div>
                            <p class="text-[11px] font-bold uppercase text-(--muted-foreground)">Nama</p>
                            <input type="text" name="nama" value="{{ $dir->nama ?? '' }}"
                                class="mt-1 w-full border border-(--input) rounded px-2 py-1 text-sm">
                        </div>

                        <div>
                            <p class="text-[11px] font-bold uppercase text-(--muted-foreground)">Jabatan</p>
                            <input type="text" name="jabatan" value="{{ $dir->jabatan ?? '' }}"
                                class="mt-1 w-full border border-(--input) rounded px-2 py-1 text-sm">
                        </div>

                        <div>
                            <p class="text-[11px] font-bold uppercase text-(--muted-foreground)">Masa Jabatan</p>
                            <input type="text" name="masa_jabatan" value="{{ $dir->masa_jabatan ?? '' }}"
                                class="mt-1 w-full border border-(--input) rounded px-2 py-1 text-sm">
                        </div>

                        <div>
                            <p class="text-[11px] font-bold uppercase text-(--muted-foreground)">Kontak Resmi</p>
                            <input type="text" name="kontak" value="{{ $dir->kontak ?? '' }}"
                                class="mt-1 w-full border border-(--input) rounded px-2 py-1 text-sm">
                        </div>

                    </div>

                    <!-- FILE -->
                    <label
                        class="flex items-center gap-4 border border-(--input) rounded-xl px-4 py-3 cursor-pointer hover:border-(--primary) transition bg-(--background)">

                        <!-- TEXT -->
                        <div class="flex flex-col leading-tight">
                            <span id="photoName" class="text-sm font-medium text-(--foreground)">
                                Upload Foto
                            </span>
                            <span class="text-xs text-(--muted-foreground)">
                                JPG atau PNG, maksimal 2MB
                            </span>
                        </div>

                        <!-- BUTTON -->
                        <span
                            class="ml-auto text-xs font-medium border border-(--border) px-3 py-1 rounded-lg text-(--foreground) hover:bg-(--accent) transition">
                            Pilih File
                        </span>

                        <input type="file" name="photo" class="hidden"
                            onchange="document.getElementById('photoName').innerText = this.files[0].name">
                    </label>

                    <!-- BUTTON -->
                    <button class="bg-(--primary) text-white px-4 py-2 rounded text-sm">
                        Simpan
                    </button>

                </form>

            </div>
        </div>

        <!-- ================= KERJASAMA ================= -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
            <h3 class="mb-3 text-xs font-bold tracking-wider text-(--muted-foreground) uppercase">
                Kerja Sama
            </h3>

            <!-- FORM TAMBAH -->
            <form action="{{ route('admin.states.kerjasamas.store', $state) }}" method="POST"
                class="mb-4 flex flex-col md:flex-row gap-2">
                @csrf

                {{-- TYPE KERJASAMA --}}
                <select name="type_kerjasama" class="flex-1 border border-(--input) rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Type Kerja Sama</option>
                    <option value="Kerja Sama Angkutan Udara">Angkutan Udara</option>
                    <option value="Kerja Sama Kelaikudaraan">Kelaikudaraan</option>
                    <option value="Kerja Sama Kebandarudaraan">Kebandarudaraan</option>
                    <option value="Kerja Sama Keamanan Penerbangan">Keamanan</option>
                    <option value="Kerja Sama Navigasi Penerbangan">Navigasi</option>
                    <option value="Kerja Sama Lainnya">Lainnya</option>
                </select>

                <input type="text" name="mou" placeholder="MoU"
                    class="flex-1 border border-(--input) rounded-lg px-3 py-2 text-sm">

                <input type="text" name="bentuk_kerjasama" placeholder="Bentuk"
                    class="flex-1 border border-(--input) rounded-lg px-3 py-2 text-sm" required>

                <input type="text" name="deskripsi" placeholder="Deskripsi"
                    class="flex-1 border border-(--input) rounded-lg px-3 py-2 text-sm">


                <select name="status_penerimaan" class="flex-1 border border-(--input) rounded-lg px-3 py-2 text-sm">
                    <option value="">Status Penerimaan</option>
                    <option value="Sudah Menerima">Sudah Menerima</option>
                    <option value="Penerima Potensial">Penerima Potensial</option>
                </select>
                <select name="status" class="flex-1 border border-(--input) rounded-lg px-3 py-2 text-sm" required>
                    <option value="">Status Berlaku</option>
                    <option value="Berlaku">Berlaku</option>
                    <option value="Tidak Berlaku">Tidak Berlaku</option>
                </select>

                <button class="bg-(--primary) text-white px-4 rounded-lg text-sm">
                    Tambah
                </button>
            </form>

            <!-- LIST -->
            @php
    $grouped = $state->kerjasamas->groupBy('type_kerjasama');
@endphp

@forelse ($grouped as $type => $items)

    {{-- 🔹 TYPE TITLE --}}
    <div class="mt-4">
        <p class="mb-2 text-xs font-bold tracking-wider text-(--muted-foreground)">
                                            {{ $type }}
                                        </p>

        <ul class="space-y-3">

            @foreach ($items as $item)
                <li
                    class="rounded-lg border border-(--border) p-3 hover:bg-(--accent) transition flex justify-between items-start gap-3">

                    <!-- CONTENT -->
                    <div>
                        <p class="text-sm font-semibold text-(--foreground)">
                            {{ $item->bentuk_kerjasama }}

                            {{-- STATUS PENERIMAAN --}}
                            @if ($item->status_penerimaan)
                                ({{ $item->status_penerimaan }})
                            @endif

                            {{-- STATUS BERLAKU --}}
                            @if ($item->status === 'Tidak Berlaku')
                                <span class="ml-1 text-[10px] text-red-500">
                                    (tidak berlaku)
                                </span>
                            @endif
                        </p>

                        @if ($item->deskripsi)
                            <p class="mt-1 text-xs text-(--muted-foreground)">
                                {{ $item->deskripsi }}
                            </p>
                        @endif
                    </div>

                    <!-- ACTION -->
                    <form action="{{ route('admin.kerjasama.destroy', $item) }}" method="POST"
                        onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-500 hover:text-red-700 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="1.5"
                                    d="m20 9l-1.995 11.346A2 2 0 0 1 16.035 22h-8.07a2 2 0 0 1-1.97-1.654L4 9m17-3h-5.625M3 6h5.625m0 0V4a2 2 0 0 1 2-2h2.75a2 2 0 0 1 2 2v2m-6.75 0h6.75" />
                            </svg>
                        </button>
                    </form>

                </li>
            @endforeach

        </ul>
    </div>

@empty
    <div
        class="rounded-lg border border-dashed border-(--border) px-3 py-2.5 text-center text-xs text-(--muted-foreground)">
        Belum ada data
    </div>
@endforelse

        </div>

    </section>
@endsection
