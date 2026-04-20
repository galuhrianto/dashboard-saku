<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
});

Schedule::call(function () {

$users = User::all();

foreach ($users as $user) {

    // AUTO
    if ($user->password_mode === 'auto') {

        $password = Str::random(8);

        $user->update([
            'password' => bcrypt($password),
            'password_initialized_at' => now(),
        ]);

        Http::withHeaders([ 'Authorization' => env('FONNTE_TOKEN') ])
        ->post('https://api.fonnte.com/send', 
            [ 
            'target' => $user->phone, 
            'message' => "Halo {$user->name},\n\n🔐 One on One Diplomacy e-book\n\nPassword terbaru akun Anda:\n{$password}\n\nGunakan password ini untuk login.\n\nMohon untuk tidak membagikan informasi ini kepada siapa pun." 
            ]);
    }
}

})
->dailyAt('09:00')
->when(fn () => now()->day % 2 === 0);