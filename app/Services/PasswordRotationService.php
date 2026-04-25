<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\BackupReceiver;

class PasswordRotationService
{
    public function handle()
    {
        $users = User::all();
        $receivers = BackupReceiver::where('is_active', true)->get();

        $backupData = [];

        foreach ($users as $user) {

            if ($user->password_mode === 'auto') {

                $password = Str::random(8);

                $user->update([
                    'password' => Hash::make($password),
                    'password_initialized_at' => now(),
                ]);

                $this->sendToUser($user, $password);

                $backupData[$user->username] = $password;

                sleep(3);
            }
        }

        $this->sendToReceivers($receivers, $users, $backupData);
    }

    protected function sendToUser($user, $password)
    {
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
    }

    protected function sendToReceivers($receivers, $users, $backupData)
    {
        foreach ($receivers as $r) {

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

            $message .= "⚠️ Mohon untuk tidak membagikan informasi ini kepada siapa pun.";

            Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                'target' => $r->phone,
                'message' => $message
            ]);

            sleep(3);
        }
    }
}