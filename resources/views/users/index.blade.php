@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">User Management</h2>

<!-- ➕ TAMBAH USER -->
<div class="bg-white p-4 rounded-xl shadow mb-4">
    <form method="POST" action="{{ route('users.store') }}" class="flex gap-3">
        @csrf

        <input name="name" placeholder="Nama" 
            class="border p-2 rounded w-1/3" required>

        <input name="username" placeholder="Username" 
            class="border p-2 rounded w-1/3" required>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Tambah
        </button>
    </form>
</div>

<!-- 📋 LIST USER -->
<div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Nama</th>
                <th class="p-3">Username</th>
                <th class="p-3">Role</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr class="border-t">
                <td class="p-3">{{ $user->name }}</td>
                <td class="p-3">{{ $user->username }}</td>

                <!-- ✏️ EDIT ROLE -->
                <td class="p-3">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <select name="role_id" 
                                onchange="this.form.submit()" 
                                class="border p-1 rounded">

                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach

                        </select>
                    </form>
                </td>

                <!-- ❌ DELETE -->
                <td class="p-3">
                    @if($user->role_id != 1) <!-- 🔥 admin ga bisa dihapus -->
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-2 py-1 rounded">
                            Delete
                        </button>
                    </form>
                    @else
                        <span class="text-gray-400 text-sm">Admin</span>
                    @endif
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-400">
                    Belum ada user
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection