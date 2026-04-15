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


            @if ($tree->isEmpty())
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div
                        class="w-16 h-16 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 font-medium">Belum ada data struktur organisasi.</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mulai tambahkan pucuk pimpinan terlebih dahulu.
                    </p>
                </div>
            @else
                <div class="flex flex-col w-full gap-0">
                    @foreach ($tree as $node)
                        @include('admin.head_offices.partials.node', ['node' => $node, 'isRoot' => true])
                    @endforeach
                </div>
            @endif


    </section>
@endsection