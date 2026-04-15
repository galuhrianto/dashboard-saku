@extends('layouts.admin.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

        <!-- ================= AIDEMEMOIRE ================= -->

        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-(--foreground) mb-4">Aide Memoire</h2>


            @if ($aidememoire)
                <p class="text-sm text-(--muted-foreground) mb-2">
                    {{ $aidememoire->title ?? 'File tersedia' }}
                </p>

                <a href="{{ asset('storage/' . $aidememoire->file_path) }}" target="_blank"
                    class="text-blue-600 text-sm hover:underline">
                    Lihat File
                </a>
            @endif

            <form action="{{ route('admin.media.upload.aidememoire') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 space-y-2">
                @csrf

                {{-- <input type="text" name="title" placeholder="Judul (optional)"
    class="w-full rounded-lg border border-(--input) bg-(--background) px-3 py-2 text-sm"> --}}

                <label
                    class="flex items-center gap-3 border border-(--input) rounded-xl px-4 py-3 cursor-pointer hover:border-(--primary) transition">

                    <span id="fileName" class="text-sm text-(--muted-foreground) truncate">
                        Pilih file...
                    </span>

                    <span class="ml-auto text-xs font-medium bg-(--secondary) px-3 py-1 rounded-lg text-(--foreground)">
                        Browse
                    </span>

                    <input type="file" name="file" required class="hidden" accept=".pdf,.doc,.docx"
                        onchange="document.getElementById('fileName').innerText = this.files[0].name">
                </label>

                <button class="bg-(--primary) text-white px-4 py-2 rounded-xl text-sm hover:opacity-90 transition">
                    Upload / Replace
                </button>
            </form>


        </div>

        <!-- ================= ASTA CITA ================= -->

        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-(--foreground) mb-4">Asta Cita</h2>


            @if ($astacita)
                <p class="text-sm text-(--muted-foreground) mb-2">
                    {{ $astacita->title ?? 'File tersedia' }}
                </p>

                <a href="{{ route('astacita') }}" target="_blank"
                    class="text-blue-600 text-sm hover:underline">
                    Lihat File
                </a>
            @endif

            <form action="{{ route('admin.media.upload.astacita') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 space-y-2">
                @csrf

                {{-- <input type="text" name="title" placeholder="Judul (optional)"
    class="w-full rounded-lg border border-(--input) bg-(--background) px-3 py-2 text-sm"> --}}

                <label
                    class="flex items-center gap-3 border border-(--input) rounded-xl px-4 py-3 cursor-pointer hover:border-(--primary) transition">

                    <span id="imageName" class="text-sm text-(--muted-foreground) truncate">
                        Pilih file...
                    </span>

                    <span class="ml-auto text-xs font-medium bg-(--secondary) px-3 py-1 rounded-lg text-(--foreground)">
                        Browse
                    </span>

                    <input type="file" name="image" required class="hidden" accept=".jpg,.jpeg,.png"
                        onchange="document.getElementById('imageName').innerText = this.files[0].name">
                </label>

                <button class="bg-(--primary) text-white px-4 py-2 rounded-xl text-sm hover:opacity-90 transition">
                    Upload / Replace
                </button>
            </form>


        </div>

        <!-- ================= ICAO OFFICE ================= -->

        {{-- <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm md:col-span-2">


            <h2 class="text-sm font-semibold text-(--foreground) mb-4">ICAO Head Office</h2>

            <!-- FORM TAMBAH -->
            <form action="{{ route('admin.media.office.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                @csrf

                <input type="text" name="name" placeholder="Nama"
                    class="rounded-lg border border-(--input) bg-(--background) px-3 py-2 text-sm" required>

                <input type="text" name="position" placeholder="Jabatan"
                    class="rounded-lg border border-(--input) bg-(--background) px-3 py-2 text-sm" required>

                <label
                    class="flex items-center gap-3 border border-(--input) rounded-xl px-4 py-3 cursor-pointer hover:border-(--primary) transition">

                    <span id="photoName" class="text-sm text-(--muted-foreground) truncate">
                        Pilih file...
                    </span>

                    <span class="ml-auto text-xs font-medium bg-(--secondary) px-3 py-1 rounded-lg text-(--foreground)">
                        Browse
                    </span>

                    <input type="file" name="photo" required class="hidden" accept=".jpg,.jpeg,.png"
                        onchange="document.getElementById('photoName').innerText = this.files[0].name">
                </label>

                <button class="bg-(--primary) text-white px-4 py-2 rounded-xl text-sm hover:opacity-90 transition">
                    Tambah
                </button>
            </form>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    <thead class="bg-(--secondary) text-(--secondary-foreground)">
                        <tr>
                            <th class="px-4 py-2">Foto</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Jabatan</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($offices as $office)
                            <tr class="border-t border-(--border)/80 hover:bg-(--accent)/60">

                                <td class="px-4 py-2">
                                    @if ($office->photo)
                                        <img src="{{ asset('storage/' . $office->photo) }}"
                                            class="w-12 h-12 object-cover rounded">
                                    @endif
                                </td>

                                <td class="px-4 py-2 text-(--foreground)">
                                    {{ $office->name }}
                                </td>

                                <td class="px-4 py-2 text-(--muted-foreground)">
                                    {{ $office->position }}
                                </td>

                                <td class="px-4 py-2">

                                    <form action="{{ route('admin.media.office.destroy', $office) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 text-xs hover:underline">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-(--muted-foreground)">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>


        </div> --}}

    </div>
@endsection
