@extends ('layouts.admin.app')

@section ('content')
  <section class="space-y-6">
    <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm sm:p-6">
      <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
          <h1 class="text-2xl font-semibold tracking-tight">User Management</h1>
          <p class="mt-1 text-sm text-(--muted-foreground)">Kelola akun pengguna, role, dan akses sistem dalam satu halaman.</p>
        </div>

        <div
          class="rounded-lg border border-(--border) bg-(--secondary) px-3 py-2 text-sm text-(--secondary-foreground)"
        >
          Total User: <span class="font-semibold text-(--foreground)">{{ $users->count() }}</span>
        </div>
      </div>

      <form
        method="POST"
        action="{{ route('admin.users.store') }}"
        class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3"
      >
        @csrf

        <input
          name="name"
          placeholder="Nama"
          class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35"
          required
        />

        <input
          name="username"
          placeholder="Username"
          class="w-full rounded-(--radius) border border-(--input) bg-(--background) px-3.5 py-2.5 text-sm transition outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--ring)/35"
          required
        />

        <button
          class="inline-flex h-10.5 items-center justify-center rounded-(--radius) bg-(--primary) px-4 text-sm font-semibold text-(--primary-foreground) transition hover:brightness-105"
        >
          Tambah User
        </button>
      </form>
    </div>

    <div class="overflow-hidden rounded-2xl border border-(--border) bg-(--card) shadow-sm">
      <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
          <thead class="bg-(--secondary) text-(--secondary-foreground)">
            <tr>
              <th class="px-4 py-3 font-semibold">Nama</th>
              <th class="px-4 py-3 font-semibold">Username</th>
              <th class="px-4 py-3 font-semibold">Role</th>
              <th class="px-4 py-3 font-semibold">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
              <tr class="border-t border-(--border)/80 transition hover:bg-(--accent)/60">
                <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                <td class="px-4 py-3 text-(--muted-foreground)">{{ $user->username }}</td>

                <td class="px-4 py-3">
                  <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method ('PUT')

                    <select
                      name="role_id"
                      onchange="this.form.submit()"
                      class="rounded-(--radius) border border-(--input) bg-(--background) px-2.5 py-1.5 text-xs font-medium transition outline-none focus:border-(--primary)"
                    >
                      @foreach ($roles as $role)
                        <option
                          value="{{ $role->id }}"
                          {{ $user->role_id == $role->id ? 'selected' : '' }}
                        >
                          {{ ucfirst($role->name) }}
                        </option>
                      @endforeach
                    </select>
                  </form>
                </td>

                <td class="px-4 py-3">
                  @if ($user->role_id != 1)
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                      @csrf
                      @method ('DELETE')

                      <button
                        class="inline-flex items-center rounded-(--radius) bg-(--destructive) px-3 py-1.5 text-xs font-semibold text-white transition hover:brightness-110"
                      >
                        Delete
                      </button>
                    </form>
                  @else
                    <span
                      class="inline-flex items-center rounded-full bg-(--secondary) px-2.5 py-1 text-xs font-medium text-(--secondary-foreground)"
                    >
                      Admin
                    </span>
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
