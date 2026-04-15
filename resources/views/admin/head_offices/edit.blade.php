@extends('layouts.admin.app')

@section('content')
    <div class="max-w-3xl mx-auto py-4">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h2 class="text-xl font-bold mb-6 text-gray-800">Edit Anggota Organisasi</h2>

            <form action="{{ route('admin.head_offices.update', $headOffice->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Atasan (Opsional)</label>
                    <select name="parent_id"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="">-- Pucuk Pimpinan (Root) --</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ (old('parent_id') ?? $headOffice->parent_id) == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }} ({{ $parent->position }})
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') ?? $headOffice->name }}"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                            required>
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" name="position" value="{{ old('position') ?? $headOffice->position }}"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                            required>
                        @error('position')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Profile</label>
                    @if ($headOffice->photo)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $headOffice->photo) }}"
                                class="h-20 w-20 object-cover rounded-md border">
                        </div>
                    @endif
                    <input type="file" name="photo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                    @error('photo')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.head_offices.index') }}"
                        class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700">Perbarui
                        Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
