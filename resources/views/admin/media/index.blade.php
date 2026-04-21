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

        {{-- <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
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

//                <input type="text" name="title" placeholder="Judul (optional)"
  //  class="w-full rounded-lg border border-(--input) bg-(--background) px-3 py-2 text-sm">

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


        </div> --}}

        <!-- ================= STRATEGI PENCALONAN ================= -->

        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-(--foreground) mb-4">Strategi Pencalonan</h2>


            @if ($strategipencalonan)
                <p class="text-sm text-(--muted-foreground) mb-2">
                    {{ $strategipencalonan->title ?? 'File tersedia' }}
                </p>

                <a href="{{ asset('storage/' . $strategipencalonan->file_path) }}" target="_blank"
                    class="text-blue-600 text-sm hover:underline">
                    Lihat File
                </a>
            @endif

            <form action="{{ route('admin.media.upload.strategipencalonan') }}" method="POST" enctype="multipart/form-data"
                class="mt-4 space-y-2">
                @csrf

                {{-- <input type="text" name="title" placeholder="Judul (optional)"
    class="w-full rounded-lg border border-(--input) bg-(--background) px-3 py-2 text-sm"> --}}

                <label
                    class="flex items-center gap-3 border border-(--input) rounded-xl px-4 py-3 cursor-pointer hover:border-(--primary) transition">

                    <span id="strategiName" class="text-sm text-(--muted-foreground) truncate">
                        Pilih file...
                    </span>

                    <span class="ml-auto text-xs font-medium bg-(--secondary) px-3 py-1 rounded-lg text-(--foreground)">
                        Browse
                    </span>

                    <input type="file" name="file" required class="hidden" accept=".pdf,.doc,.docx"
                        onchange="document.getElementById('strategiName').innerText = this.files[0].name">
                </label>

                <button class="bg-(--primary) text-white px-4 py-2 rounded-xl text-sm hover:opacity-90 transition">
                    Upload / Replace
                </button>
            </form>


        </div>

    </div>
@endsection
