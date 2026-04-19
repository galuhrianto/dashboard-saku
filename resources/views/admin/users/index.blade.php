@extends ('layouts.admin.app')

@section('content')
    <section class="space-y-6">
        <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm sm:p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">User Management</h1>
                    <p class="mt-1 text-sm text-(--muted-foreground)">Kelola akun pengguna, role, dan akses sistem dalam satu
                        halaman.</p>
                </div>

                <div
                    class="rounded-lg border border-(--border) bg-(--secondary) px-3 py-2 text-sm text-(--secondary-foreground)">
                    Total User: <span class="font-semibold text-(--foreground)">{{ $users->count() }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="mt-5 space-y-3">
                @csrf

                <!-- GRID INPUT -->
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">

                    <input name="name" placeholder="Nama"
                        class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35"
                        required />

                    <input name="username" placeholder="Username"
                        class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35"
                        required />

                    <input name="phone" placeholder="Nomor WhatsApp"
                        class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35"
                        required />

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end">
                    <button
                        class="inline-flex h-10.5 items-center justify-center rounded-(--radius) bg-(--primary) px-5 text-sm font-semibold text-(--primary-foreground) transition hover:brightness-105">
                        Tambah User
                    </button>
                </div>

            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-(--border) bg-(--card) shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-(--secondary) text-(--secondary-foreground)">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Nama</th>
                            <th class="px-4 py-3 font-semibold">Username</th>
                            <th class="px-4 py-3 font-semibold">No WA </th>
                            <th class="px-4 py-3 font-semibold">Role</th>
                            <th class="px-4 py-3 font-semibold w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-t border-(--border)/80 transition hover:bg-(--accent)/60">
                                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-(--muted-foreground)">{{ $user->username }}</td>
                                <td class="px-4 py-3 text-(--muted-foreground)">{{ $user->phone }}</td>

                                {{-- Kolom Role --}}
                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="role_id" onchange="this.form.submit()"
                                            class="rounded-(--radius) border border-(--input) bg-(--background) px-2.5 py-1.5 text-xs font-medium transition outline-none focus:border-(--primary)">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="px-4 py-3 w-48">
                                    {{-- Form Ubah Password Mode --}}
                                    <form method="POST" action="{{ route('users.password_mode', $user->id) }}"
                                        class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="password_mode" onchange="this.form.submit()"
                                            class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-2.5 py-1.5 text-xs font-medium transition outline-none focus:border-(--primary)">
                                            <option value="auto" {{ $user->password_mode === 'auto' ? 'selected' : '' }}>
                                                AUTO</option>
                                            <option value="off" {{ $user->password_mode === 'off' ? 'selected' : '' }}>
                                                OFF</option>
                                        </select>
                                    </form>

                                    {{-- Resend Link (Hanya jika mode OFF) --}}
                                    @if ($user->password_mode === 'off')
                                        <form method="POST" action="{{ route('users.resend-reset', $user->id) }}"
                                            class="mb-2">
                                            @csrf
                                            <button
                                                class="w-full rounded-(--radius) border border-(--border) bg-(--secondary) px-2.5 py-1.5 text-xs font-medium text-(--secondary-foreground) transition hover:bg-(--accent)">
                                                Resend Link
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Action Delete atau Badge Admin --}}
                                    @if ($user->role_id != 1)
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-flex w-full justify-center items-center rounded-(--radius) bg-(--destructive) px-3 py-1.5 text-xs font-semibold text-white transition hover:brightness-110">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex justify-center">
                                            <span
                                                class="inline-flex items-center rounded-full bg-(--secondary) px-2.5 py-1 text-xs font-medium text-(--secondary-foreground)">
                                                Admin
                                            </span>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-(--muted-foreground)">
                                    Belum ada user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
