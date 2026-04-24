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

                @error('username')
                    <div
                        class="mt-1 flex items-center gap-2 text-xs text-red-600 bg-red-50 border border-red-200 rounded px-2 py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                @if (session('success'))
                    <div id="successAlert"
                        class="mb-3 flex items-center gap-2 text-sm text-green-700 bg-green-50 border border-green-200 rounded px-3 py-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                        <span>{{ session('success') }}</span>
                    </div>
                @endif
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
                                    @if ($user->password_mode === 'auto')
                                    <form action="{{ route('admin.reset.wa', $user) }}" method="POST" target="_blank"
                                        onsubmit="return confirm('Reset password & kirim manual WA?')">
                                        @csrf

                                        <button
                                            class="mt-2 bg-green-500 text-white px-3 py-1.5 rounded text-xs hover:bg-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-4 h-4 text-white">
                                                <path
                                                    d="M20.52 3.48A11.91 11.91 0 0012.06 0C5.48 0 .13 5.35.13 11.93c0 2.1.55 4.16 1.6 5.98L0 24l6.26-1.64a11.86 11.86 0 005.8 1.48h.01c6.58 0 11.93-5.35 11.93-11.93 0-3.18-1.24-6.17-3.48-8.43zM12.07 21.3c-1.8 0-3.57-.48-5.11-1.38l-.36-.21-3.71.97.99-3.61-.24-.37a9.28 9.28 0 01-1.42-4.93c0-5.15 4.19-9.34 9.35-9.34 2.49 0 4.83.97 6.59 2.74a9.27 9.27 0 012.73 6.6c0 5.15-4.19 9.33-9.34 9.33zm5.12-6.97c-.28-.14-1.65-.81-1.91-.9-.26-.09-.45-.14-.64.14-.19.28-.74.9-.9 1.09-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.25-1.37-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.33.42-.5.14-.17.19-.28.28-.47.09-.19.05-.36-.02-.5-.07-.14-.64-1.55-.88-2.13-.23-.56-.47-.48-.64-.49l-.55-.01c-.19 0-.5.07-.76.36-.26.28-1 1-1 2.44 0 1.44 1.03 2.84 1.17 3.04.14.19 2.03 3.1 4.92 4.34.69.3 1.22.48 1.64.61.69.22 1.32.19 1.82.12.56-.08 1.65-.67 1.88-1.32.23-.65.23-1.21.16-1.32-.07-.11-.26-.17-.54-.31z" />
                                            </svg>
                                        </button>
                                    </form>
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

        <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm mt-6 overflow-visible">
            <div class="overflow-visible">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-(--secondary) text-(--secondary-foreground)">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Penerima</th>
                            <th class="px-4 py-3 font-semibold">Akun</th>
                            <th class="px-4 py-3 font-semibold">No WA</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold w-40 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="overflow-visible">
                        @forelse($receivers as $r)
                            <tr class="border-t border-(--border)/80 transition hover:bg-(--accent)/60 overflow-visible">

                                <td class="px-4 py-3 font-medium">
                                    {{ $r->name ?? '-' }}
                                </td>

                                <td class="px-4 py-3 overflow-visible">
                                    <form method="POST" action="{{ route('admin.backup.accounts', $r) }}"
                                        data-id="{{ $r->id }}" class="backup-form">
                                        @csrf
                                        @method('PATCH')

                                        <div id="chips-{{ $r->id }}" class="flex flex-wrap gap-1 mb-2">
                                            @foreach ($r->accounts ?? [] as $acc)
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[10px] bg-(--secondary)"
                                                    data-value="{{ $acc }}">
                                                    {{ $acc }}
                                                    <button type="button"
                                                        onclick="removeChip(this, {{ $r->id }})">✕</button>
                                                </span>
                                            @endforeach
                                        </div>

                                        <input type="hidden" name="accounts">

                                        <div class="relative">
                                            <input type="text" placeholder="ketik username..."
                                                class="text-xs border border-(--input) rounded px-2 py-1 w-40 focus:ring-1 focus:ring-blue-500 outline-none"
                                                oninput="searchUser(this, {{ $r->id }})" autocomplete="off">

                                            <div id="dropdown-{{ $r->id }}"
                                                class="absolute left-0 top-full mt-1 z-50 bg-white border border-gray-200 rounded shadow-xl text-xs w-48 hidden max-h-48 overflow-y-auto">
                                            </div>
                                        </div>
                                    </form>
                                </td>

                                <td class="px-4 py-3 text-(--muted-foreground)">
                                    {{ $r->phone }}
                                </td>

                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('admin.backup.toggle', $r) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="inline-flex items-center rounded-(--radius) px-2.5 py-1 text-xs font-medium transition
                            {{ $r->is_active
                                ? 'bg-green-100 text-green-700 hover:brightness-95'
                                : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}">
                                            {{ $r->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>

                                <td class="px-4 py-3 text-right">
                                    <form method="POST" action="{{ route('admin.backup.destroy', $r) }}"
                                        onsubmit="return confirm('Hapus receiver ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="inline-flex items-center rounded-(--radius) bg-(--destructive) px-3 py-1.5 text-xs font-semibold text-white transition hover:brightness-110">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-(--muted-foreground)">
                                    Belum ada backup receiver
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <script>
            const users = @json($users->pluck('username'));

            function searchUser(input, id) {
                const val = input.value.toLowerCase();
                const dropdown = document.getElementById('dropdown-' + id);

                dropdown.innerHTML = '';

                if (!val) {
                    dropdown.classList.add('hidden');
                    return;
                }

                const results = users.filter(u => u.toLowerCase().includes(val));

                if (!results.length) {
                    dropdown.classList.add('hidden');
                    return;
                }

                results.slice(0, 5).forEach(u => {
                    const item = document.createElement('div');
                    item.className = "px-2 py-1 hover:bg-gray-100 cursor-pointer";
                    item.innerText = u;

                    item.onclick = () => selectUser(u, id, input);

                    dropdown.appendChild(item);
                });

                dropdown.classList.remove('hidden');
            }

            function selectUser(username, id, input) {
                const box = document.getElementById('chips-' + id);
                const form = document.querySelector(`form[data-id="${id}"]`);

                if ([...box.children].some(c => c.dataset.value === username)) {
                    input.value = '';
                    return;
                }

                const chip = document.createElement('span');
                chip.className = "inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[10px] bg-(--secondary)";
                chip.dataset.value = username;

                chip.innerHTML = `
        ${username}
        <button type="button" onclick="removeChip(this, ${id})">✕</button>
    `;

                box.appendChild(chip);

                input.value = '';
                document.getElementById('dropdown-' + id).classList.add('hidden');

                submitAccounts(form, id);
            }

            function removeChip(btn, id) {
                const form = document.querySelector(`form[data-id="${id}"]`);
                btn.parentElement.remove();

                submitAccounts(form, id);
            }

            function submitAccounts(form, id) {
                const box = document.getElementById('chips-' + id);
                const hidden = form.querySelector('input[name=accounts]');

                const values = Array.from(box.querySelectorAll('[data-value]'))
                    .map(el => el.dataset.value);

                hidden.value = JSON.stringify(values);

                form.submit();
            }
        </script>

    </section>
@endsection
