@extends ('layouts.app')

@section ('content')
  @php
    $partLabel = is_null($state->council_part) ? '-' : 'Part ' . $state->council_part;
    $partStyle = [
        null => 'background:#e5e7eb;color:#374151;',
        1 => 'background:#dcfce7;color:#166534;',
        2 => 'background:#dbeafe;color:#1d4ed8;',
        3 => 'background:#fef3c7;color:#b45309;',
    ][$state->council_part] ?? 'background:#e5e7eb;color:#374151;';

    $dctpStyle = [
        'Belum Menerima' => 'background:#fee2e2;color:#b91c1c;',
        'Sudah Menerima' => 'background:#d1fae5;color:#047857;',
        'Potensial Menerima' => 'background:#fef3c7;color:#b45309;',
    ][$state->dctp_enum] ?? 'background:#e5e7eb;color:#374151;';

    $countryCode = strtoupper((string) ($state->country_code ?? $state->iso2 ?? $state->iso_code ?? ''));
    $flagUrl = strlen($countryCode) === 2 ? 'https://flagcdn.com/w80/' . strtolower($countryCode) . '.png' : null;
@endphp
  <section class="space-y-6">
    <div class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm sm:p-6">
      <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
          <p class="text-xs font-semibold tracking-[0.16em] text-(--muted-foreground) uppercase">State Profile</p>
          <div class="mt-3 flex items-center gap-3">
            <div
              class="h-10 w-14 overflow-hidden rounded-md border border-(--border) bg-(--secondary)"
            >
              @if ($flagUrl)
                <img
                  src="{{ $flagUrl }}"
                  alt="Bendera {{ $state->state_name }}"
                  class="h-full w-full object-cover"
                  loading="lazy"
                  onerror="
                    this.style.display = 'none';
                    this.nextElementSibling.style.display = 'flex';
                  "
                />
                <span
                  class="hidden h-full w-full items-center justify-center text-[10px] font-semibold text-(--muted-foreground)"
                >
                  {{ $countryCode ?: 'N/A' }}
                </span>
              @else
                <span
                  class="flex h-full w-full items-center justify-center text-[10px] font-semibold text-(--muted-foreground)"
                >
                  N/A
                </span>
              @endif
            </div>

            <h1 class="text-3xl font-semibold tracking-tight">{{ $state->state_name }}</h1>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <span
            class="rounded-full px-3 py-1 text-xs font-semibold"
            style="background: #e2e8f0; color: #334155"
          >
            {{ $state->icao_region ?? '-' }}
          </span>
          </span>
          <span class="rounded-full px-3 py-1 text-xs font-semibold" style="{{ $partStyle }}">
            {{ $partLabel }}
          </span>
        </div>
      </div>

      <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3">
        <div class="rounded-xl border border-(--border) bg-(--background) p-3">
          <p class="text-xs text-(--muted-foreground)">Nama Negara</p>
          <p class="mt-1 font-medium">{{ $state->state_name ?? '-' }}</p>
        </div>
        <div class="rounded-xl border border-(--border) bg-(--background) p-3">
          <p class="text-xs text-(--muted-foreground)">Ibu Kota</p>
          <p class="mt-1 font-medium">{{ $state->capital_city ?? '-' }}</p>
        </div>
        <div class="rounded-xl border border-(--border) bg-(--background) p-3">
          <p class="text-xs text-(--muted-foreground)">Region ICAO</p>
          <p class="mt-1 font-medium">{{ $state->icao_region ?? '-' }}</p>
        </div>
        <div class="rounded-xl border border-(--border) bg-(--background) p-3">
          <p class="text-xs text-(--muted-foreground)">Regional Office</p>
          <p class="mt-1 font-medium">{{ $state->icao_regional_office ?? '-' }}</p>
        </div>
        <div class="rounded-xl border border-(--border) bg-(--background) p-3">
          <p class="text-xs text-(--muted-foreground)">Representative in Council</p>
          <p class="mt-1 font-medium">{{ $state->rep_in_council ?? '-' }}</p>
        </div>
        <div class="rounded-xl border border-(--border) bg-(--background) p-3">
          <p class="text-xs text-(--muted-foreground)">Council Part</p>
          <p class="mt-1 font-medium">{{ $partLabel }}</p>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
      <article class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
        <h3 class="text-sm font-semibold">Direktur</h3>
        <ul class="mt-3 space-y-2 text-sm">
          @forelse ($state->direktur as $d)
            <li class="rounded-lg border border-(--border) bg-(--background) px-3 py-2">
              <p class="font-medium">{{ $d->nama }}</p>
              <p class="text-xs text-(--muted-foreground)">{{ $d->jabatan ?? '-' }}</p>
            </li>
          @empty
            <li
              class="rounded-lg border border-(--border) bg-(--background) px-3 py-2 text-(--muted-foreground)"
            >
              Tidak ada data
            </li>
          @endforelse
        </ul>
      </article>

      <article class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
        <h3 class="text-sm font-semibold">Kerja Sama</h3>
        <ul class="mt-3 space-y-2 text-sm">
          @forelse ($state->kerjasama as $k)
            <li class="rounded-lg border border-(--border) bg-(--background) px-3 py-2">
              {{ $k->bentuk_kerjasama ?? '-' }}
            </li>
          @empty
            <li
              class="rounded-lg border border-(--border) bg-(--background) px-3 py-2 text-(--muted-foreground)"
            >
              Tidak ada data
            </li>
          @endforelse
        </ul>
      </article>

      <article class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm">
        <h3 class="text-sm font-semibold">Beasiswa</h3>
        <ul class="mt-3 space-y-2 text-sm">
          @forelse ($state->beasiswa as $b)
            <li class="rounded-lg border border-(--border) bg-(--background) px-3 py-2">
              <p class="font-medium">{{ $b->nama_penerima ?? '-' }}</p>
              <p class="text-xs text-(--muted-foreground)">Tahun: {{ $b->tahun ?? '-' }}</p>
            </li>
          @empty
            <li
              class="rounded-lg border border-(--border) bg-(--background) px-3 py-2 text-(--muted-foreground)"
            >
              Tidak ada data
            </li>
          @endforelse
        </ul>
      </article>
    </div>
  </section>

@endsection
