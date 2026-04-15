@extends('layouts.admin.app')

@section('content')
    <div class="w-full">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Struktur Organisasi</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola hierarki dan daftar anggota pengurus.</p>
            </div>
            <a href="{{ route('admin.head_offices.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-xl transition-all shadow-sm hover:shadow-md active:scale-95 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Anggota
            </a>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-3 p-4 mb-6 text-sm text-green-800 border border-green-200 rounded-xl bg-green-50 dark:bg-green-900/50 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg class="shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-4 sm:p-6 lg:p-8 w-full">

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
        </div>
    </div>
@endsection
