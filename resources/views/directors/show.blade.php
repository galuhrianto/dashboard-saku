@extends('layouts.app')

@section('content')
    <section class="space-y-6">


        <!-- Header -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-6 shadow-sm">
            <h1 class="text-2xl font-semibold tracking-tight">
                Direktur Perwakilan Negara
            </h1>
            <p class="text-sm text-(--muted-foreground)">
                Galeri direktur dari masing-masing negara anggota ICAO
            </p>
        </div>



        <!-- Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">

            @foreach ($direkturs as $direktur)
                <div href="#" class="group rounded-2xl border border-(--border) bg-(--card) overflow-hidden shadow-sm">

                    <!-- Foto -->
                    @if ($direktur->foto)
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ asset('ig/' . $direktur->foto) }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center rounded-xl border border-dashed border-(--border) bg-(--secondary)/30 p-5 text-center">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-(--border)">
                                FOTO
                            </div>
                            <p class="mt-3 text-xs text-(--muted-foreground)">Foto belum tersedia</p>
                        </div>
                    @endif

                    <!-- Info -->
                    <div class="p-3">
                        <h3 class="text-sm font-semibold">
                            {{ $direktur->nama ?? '-' }}
                        </h3>
                        <p class="text-xs text-(--muted-foreground)">
                            {{ $direktur->jabatan ?? '-' }}
                        </p>
                        <p class="text-xs text-(--muted-foreground)">
                            {{ $direktur->state->state_name ?? '-' }}
                        </p>
                    </div>

                </div>
            @endforeach

        </div>

    </section>
@endsection
