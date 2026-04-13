@extends('layouts.app')

@section('content')
    <section class="space-y-6">

        <!-- Header -->
        <div class="rounded-2xl border border-(--border) bg-(--card) p-6 shadow-sm">
            <h1 class="text-2xl font-semibold tracking-tight">
                The ICAO Head Office
            </h1>
            <p class="text-sm text-(--muted-foreground)">
                Struktur pimpinan utama ICAO
            </p>
        </div>

        <!-- Grid -->
        <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3">

            <!-- Card 1 -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-lg text-center space-y-4">

                <!-- Placeholder Image -->
                <div
                    class="flex flex-col items-center rounded-xl border border-dashed border-(--border) bg-(--secondary)/30 p-6 text-center">

                    <div class="w-full aspect-[3/4] overflow-hidden rounded-xl">
                        <img src="{{ asset('img/pg.jpeg') }}" class="w-full h-full object-cover">
                    </div>
                    <p class="mt-4 text-xs text-(--muted-foreground)">
                        President of the Council
                    </p>

                    <h3 class="text-base font-semibold">
                        Mr. Toshiyuki Onoma
                    </h3>

                </div>

            </div>

            <!-- Card 2 -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-lg text-center space-y-4">

                <div
                    class="flex flex-col items-center rounded-xl border border-dashed border-(--border) bg-(--secondary)/30 p-6 text-center">

                    <div class="w-full aspect-[3/4] overflow-hidden rounded-xl">
                        <img src="{{ asset('img/sg.jpeg') }}" class="w-full h-full object-cover">
                    </div>

                    <p class="mt-4 text-xs text-(--muted-foreground)">
                        Secretary General
                    </p>
                    <h3 class="text-sm font-semibold">
                        Mr. Juan Carlos Salazar
                    </h3>
                </div>

            </div>

            <!-- Card 3 -->
            <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-lg text-center space-y-4">

                <div
                    class="flex flex-col items-center rounded-xl border border-dashed border-(--border) bg-(--secondary)/30 p-6 text-center">

                    <div class="w-full aspect-[3/4] overflow-hidden rounded-xl">
                        <img src="{{ asset('img/rg.jpg') }}" class="w-full h-full object-cover">
                    </div>

                    <p class="mt-4 text-xs text-(--muted-foreground)">
                        Regional Director
                    </p>
                    <h3 class="text-sm font-semibold">
                        Mr. Tao Ma
                    </h3>
                </div>

            </div>

        </div>

    </section>
@endsection
