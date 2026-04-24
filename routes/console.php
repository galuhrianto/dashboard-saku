<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\BackupReceiver;

Schedule::call(function () {

    $users = User::all();
    $receivers = BackupReceiver::where('is_active', true)->get();

    $backupData = []; // kumpulin dulu

    foreach ($users as $user) {

        if ($user->password_mode === 'auto') {

            $password = Str::random(8);

            $user->update([
                'password' => Hash::make($password),
                'password_initialized_at' => now(),
            ]);

            // =====================
            // KIRIM KE USER
            // =====================
            Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                'target' => $user->phone,
                'message' => "Halo {$user->name},

🔐 One on One Diplomacy e-book

Password terbaru akun Anda:
{$password}

Gunakan password ini untuk login.

⚠️ Mohon untuk tidak membagikan informasi ini kepada siapa pun."
            ]);

            // =====================
            // SIMPAN UNTUK BACKUP
            // =====================
            $backupData[$user->username] = $password;

            // delay
            sleep(3);
        }
    }

    // =====================
    // KIRIM KE BACKUP RECEIVERS
    // =====================
    foreach ($receivers as $r) {

        // skip kalau ga ada account
        if (empty($r->accounts)) continue;

        $message = "Halo {$r->name},\n\n";
        $message .= "Perubahan password per " . now()->translatedFormat('d F Y') . "\n\n";
        $message .= "🔐 One on One Diplomacy e-book\n\n";

        foreach ($r->accounts as $acc) {

            if (isset($backupData[$acc])) {

                $user = $users->firstWhere('username', $acc);

                $message .= "*Akun {$user->name}*\n";
                $message .= "Username : {$acc}\n";
                $message .= "Password : {$backupData[$acc]}\n\n";
            }
        }

        // kalau ga ada yang cocok → skip
        if (trim($message) === "🔐 Backup Password\n\n📅 " . now()->format('d M Y')) {
            continue;
        }

        $message .= "⚠️ Mohon untuk tidak membagikan informasi ini kepada siapa pun.";

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $r->phone,
            'message' => $message
        ]);

        //delay chat backup
        sleep(3);
    }

})
->dailyAt('10:00')
->when(fn () => now()->day % 2 === 0);