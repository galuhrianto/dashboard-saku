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
    <!-- 1. Header Banner -->
    <div
      class="flex flex-col items-start justify-between gap-5 rounded-2xl border border-(--border) bg-(--card) p-6 shadow-sm sm:flex-row sm:items-center"
    >
      <div class="flex items-center gap-5">
        <div
          class="flex h-14 w-20 shrink-0 items-center justify-center overflow-hidden rounded-md border border-(--border) bg-(--secondary) shadow-sm"
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
              class="hidden text-xs font-bold text-(--muted-foreground)"
              >{{ $countryCode ?: 'N/A' }}</span
            >
          @else
            <span class="text-xs font-bold text-(--muted-foreground)">N/A</span>
          @endif
        </div>
        <div>
          <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">{{ $state->state_name }}</h1>
          <p class="mt-1 text-sm font-medium text-(--muted-foreground)">ICAO member countries</p>
        </div>
      </div>
      <div class="flex flex-wrap gap-2">
        <span
          class="rounded-full border border-slate-200 bg-slate-100 px-4 py-1.5 text-xs font-semibold tracking-wide text-slate-700 shadow-sm"
        >
          Region: {{ $state->icao_region ?? '-' }}
        </span>
        <span
          class="rounded-full border border-black/5 px-4 py-1.5 text-xs font-semibold tracking-wide shadow-sm"
          style="{{ $partStyle }}"
        >
          {{ $partLabel }}
        </span>
        @if ($state->dctp_status)
          @php
            $dctpBadge = match($state->dctp_status) {
              'Sudah Menerima' => ['bg' => 'bg-emerald-100 text-emerald-800 border-emerald-200', 'icon' => '✓'],
              'Penerima Potensial' => ['bg' => 'bg-blue-100 text-blue-800 border-blue-200', 'icon' => '◎'],
              'Prioritas Penerima Dewan ICAO' => ['bg' => 'bg-violet-100 text-violet-800 border-violet-200', 'icon' => '★'],
              'Kompetitor' => ['bg' => 'bg-rose-100 text-rose-800 border-rose-200', 'icon' => '⊗'],
              default => ['bg' => 'bg-slate-100 text-slate-700 border-slate-200', 'icon' => '—'],
            };
          @endphp
          <span
            class="rounded-full border px-4 py-1.5 text-xs font-semibold tracking-wide shadow-sm {{ $dctpBadge['bg'] }}"
          >
            DCTP: {{ $state->dctp_status }}
          </span>
        @endif
      </div>
    </div>

    <!-- 2. Core Metrics Strip -->
    {{-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div
        class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm transition hover:shadow-md"
      >
        <p class="text-xs font-bold tracking-wider text-(--muted-foreground) uppercase">Capital City</p>
        <p
          class="mt-2 text-lg leading-tight font-semibold"
          title="{{ $state->capital_city }}"
        >{{ $state->capital_city ?: '-' }}</p>
      </div>
      <div
        class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm transition hover:shadow-md"
      >
        <p class="text-xs font-bold tracking-wider text-(--muted-foreground) uppercase">Population</p>
        <p
          class="mt-2 text-lg leading-tight font-semibold"
          title="{{ $state->population }}"
        >{{ $state->population ?: '-' }}</p>
      </div>
      <div
        class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm transition hover:shadow-md"
      >
        <p class="text-xs font-bold tracking-wider text-(--muted-foreground) uppercase">Leader / Head</p>
        <p
          class="mt-2 text-lg leading-tight font-semibold"
          title="{{ $state->leader }}"
        >{{ $state->leader ?: '-' }}</p>
      </div>
      <div
        class="rounded-2xl border border-(--border) bg-(--card) p-5 shadow-sm transition hover:shadow-md"
      >
        <p class="text-xs font-bold tracking-wider text-(--muted-foreground) uppercase">Currency</p>
        <p
          class="mt-2 text-lg leading-tight font-semibold"
          title="{{ $state->currency }}"
        >{{ $state->currency ?: '-' }}</p>
      </div>
    </div> --}}

    <!-- 2.5 Director General Profile Grid -->
    <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm">
      <div class="border-b border-(--border) px-6 py-4">
        {{-- <a href="{{ route('direkturs.show', $state->id) }}" class="text-sm font-bold tracking-tight text-(--primary) hover:underline"> --}}
        <h2 class="text-base font-bold tracking-tight text-(--foreground)">
          Profil Directorate General Civil Aviation (DGCA)
        </h2>
        <a>
      </div>
      <div class="p-6">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
          <div
            class="flex flex-col items-center justify-center rounded-xl border border-dashed border-(--border) bg-(--secondary)/30 p-5 text-center"
          >
            <div
              class="flex h-20 w-20 items-center justify-center rounded-full border border-(--border) bg-(--secondary) text-sm font-bold text-(--muted-foreground)"
            >
              FOTO
            </div>
            <p class="mt-3 text-xs font-medium text-(--muted-foreground)">Foto belum tersedia</p>
          </div>

          <div class="rounded-xl border border-(--border) bg-(--secondary)/20 p-4 md:col-span-2">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
              <div>
                <p class="text-[11px] font-bold tracking-wider text-(--muted-foreground) uppercase">Nama</p>
                <p class="mt-1 text-sm font-semibold">-</p>
              </div>
              <div>
                <p class="text-[11px] font-bold tracking-wider text-(--muted-foreground) uppercase">Jabatan</p>
                <p class="mt-1 text-sm font-semibold">-</p>
              </div>
              <div>
                <p class="text-[11px] font-bold tracking-wider text-(--muted-foreground) uppercase">Masa Jabatan</p>
                <p class="mt-1 text-sm font-semibold">-</p>
              </div>
              <div>
                <p class="text-[11px] font-bold tracking-wider text-(--muted-foreground) uppercase">Kontak Resmi</p>
                <p class="mt-1 text-sm font-semibold">-</p>
              </div>
            </div>
            <div
              class="mt-4 rounded-lg border border-dashed border-(--border) px-3 py-2 text-xs text-(--muted-foreground)"
            >
              Data profil Director General belum diinput.
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 3. Two-Column Layout -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
      <!-- LEFT COLUMN (Main Content) -->
      <div class="space-y-6 lg:col-span-2">
        <!-- Executive Summary / Deskripsi -->
        <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm">
          <div class="border-b border-(--border) px-6 py-4">
            <h2 class="text-base font-bold tracking-tight text-(--foreground)">Deskripsi Umum</h2>
          </div>
          <div class="p-6">
            @if ($state->deskripsi)
              <div class="prose prose-sm max-w-none leading-relaxed text-(--foreground)">
                <p class="whitespace-pre-wrap">{{ $state->deskripsi }}</p>
              </div>
            @else
              <p class="text-sm text-(--muted-foreground) italic">Tidak ada deskripsi tersedia untuk negara ini.</p>
            @endif
          </div>
        </div>

        <!-- Strategic Engagement Panel -->
        <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm">
          <div class="border-b border-(--border) px-6 py-4">
            <h2 class="text-base font-bold tracking-tight text-(--foreground)">
              Keterlibatan &amp; Kerja Sama
            </h2>
          </div>
          <div class="p-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
              <!-- Kerja Sama -->
              <div>
  <h3 class="mb-3 text-xs font-bold tracking-wider text-(--muted-foreground) uppercase">
    Kerja Sama
  </h3>

  <ul class="space-y-3">
    @forelse ($state->kerjasamas as $item)
      <li class="rounded-lg border border-(--border) p-3 hover:bg-(--accent) transition">

        <p class="text-sm font-semibold text-(--foreground)">
          {{ $item->bentuk_kerjasama }}
        </p>

        <p class="mt-1 text-xs text-(--muted-foreground)">
          {{ $item->deskripsi }}
        </p>

      </li>
    @empty
      <li class="rounded-lg border border-dashed border-(--border) px-3 py-2.5 text-center text-xs text-(--muted-foreground)">
        Belum ada data
      </li>
    @endforelse
  </ul>
</div>

              <!-- Beasiswa -->
              <div>
                <h3
                  class="mb-3 text-xs font-bold tracking-wider text-(--muted-foreground) uppercase"
                >
                  Beasiswa
                </h3>
                <ul class="space-y-2">
                  <li
                    class="rounded-lg border border-dashed border-(--border) px-3 py-2.5 text-center text-xs text-(--muted-foreground)"
                  >
                    Belum ada data
                  </li>
                </ul>
              </div>
            </div>
            <div
              class="mt-5 rounded-lg border border-dashed border-(--border) px-3 py-2 text-xs text-(--muted-foreground)"
            >
              Data Director General, keterlibatan kerja sama, dan beasiswa disembunyikan sementara
              sampai data final diinput.
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN (Sidebar Info) -->
      <div class="space-y-6">
        <!-- ICAO Representation -->
        <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm">
          <div class="border-b border-(--border) px-5 py-3.5">
            <h3 class="text-sm font-bold tracking-tight text-(--foreground)">Representasi ICAO</h3>
          </div>
          <div class="p-5">
            <ul class="space-y-4">
              <li>
                <p class="text-xs font-medium text-(--muted-foreground)">Representative in Council</p>
                <p class="mt-1 text-sm font-semibold">{{ $state->rep_in_council ?: '-' }}</p>
              </li>
              <li>
                <p class="text-xs font-medium text-(--muted-foreground)">Regional Office</p>
                <p class="mt-1 text-sm font-semibold">{{ $state->icao_regional_office ?: '-' }}</p>
              </li>
              @if ($state->dialing_code)
                <li class="border-t border-(--border)/50 pt-2">
                  <p class="text-xs font-medium text-(--muted-foreground)">Dialing Code</p>
                  <p class="mt-1 text-sm font-semibold">{{ $state->dialing_code }}</p>
                </li>
              @endif
              @if ($state->official_languages)
                <li class="border-t border-(--border)/50 pt-2">
                  <p class="text-xs font-medium text-(--muted-foreground)">Official Languages</p>
                  <p class="mt-1 text-sm leading-snug font-semibold">{{ $state->official_languages }}</p>
                </li>
              @endif
            </ul>
          </div>
        </div>

        <!-- Posisi Dukungan -->
        @if ($state->posisi_2016 || $state->posisi_2013)
          <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm">
            <div class="border-b border-(--border) px-5 py-3.5">
              <h3 class="text-sm font-bold tracking-tight text-(--foreground)">
                Posisi Dukungan Pencalonan
              </h3>
            </div>
            <div class="p-5">
              <div class="grid grid-cols-2 gap-4">
                <div
                  class="rounded-lg border border-(--border) bg-(--secondary)/30 p-3 text-center"
                >
                  <p class="text-[10px] font-bold tracking-wider text-(--muted-foreground) uppercase">Tahun 2013</p>
                  @php
                  $color2013 = match(strtoupper($state->posisi_2013)) {
                    'YA' => 'text-emerald-600 dark:text-emerald-400 text-xs',
                    'TIDAK' => 'text-rose-600 dark:text-rose-400 text-xs',
                    'MEMPERTIMBANGKAN' => 'text-amber-600 dark:text-amber-400 text-xs',
                    default => 'text-(--foreground)',
                  };
                @endphp
                  <p
                    class="mt-1.5 text-sm font-bold {{ $color2013 }}"
                  >{{ strtoupper($state->posisi_2013 ?: '-') }}</p>
                </div>
                <div
                  class="rounded-lg border border-(--border) bg-(--secondary)/30 p-3 text-center"
                >
                  <p class="text-[10px] font-bold tracking-wider text-(--muted-foreground) uppercase">Tahun 2016</p>
                  @php
                  $color2016 = match(strtoupper($state->posisi_2016)) {
                    'YA' => 'text-emerald-600 dark:text-emerald-400 text-xs',
                    'TIDAK' => 'text-rose-600 dark:text-rose-400 text-xs',
                    'MEMPERTIMBANGKAN' => 'text-amber-600 dark:text-amber-400 text-xs',
                    default => 'text-(--foreground)',
                  };
                @endphp
                  <p
                    class="mt-1.5 text-sm font-bold {{ $color2016 }}"
                  >{{ strtoupper($state->posisi_2016 ?: '-') }}</p>
                </div>
              </div>
            </div>
          </div>
        @endif

        <!-- Additional Information -->
        @if ($state->university || $state->points_of_interest || !empty($state->additional_info))
          <div class="rounded-2xl border border-(--border) bg-(--card) shadow-sm">
            <div class="border-b border-(--border) px-5 py-3.5">
              <h3 class="text-sm font-bold tracking-tight text-(--foreground)">
                Informasi Tambahan
              </h3>
            </div>
            <div class="p-5">
              <ul class="space-y-4">
                @if ($state->points_of_interest)
                  <li>
                    <p class="text-xs font-medium text-(--muted-foreground)">Points of Interest</p>
                    <p class="mt-1 text-sm leading-snug font-semibold">{{ $state->points_of_interest }}</p>
                  </li>
                @endif

                @if ($state->university)
                  <li
                    class="{{ $state->points_of_interest ? 'pt-2 border-t border-(--border)/50' : '' }}"
                  >
                    <p class="text-xs font-medium text-(--muted-foreground)">University</p>
                    <p class="mt-1 text-sm leading-snug font-semibold">{{ $state->university }}</p>
                  </li>
                @endif

                @if (is_array($state->additional_info))
                  @foreach ($state->additional_info as $key => $val)
                    <li class="border-t border-(--border)/50 pt-2">
                      <p class="text-xs font-medium text-(--muted-foreground)">{{ $key }}</p>
                      <p class="mt-1 text-sm leading-snug font-semibold">{{ is_array($val) ? json_encode($val) : $val }}</p>
                    </li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

@endsection
