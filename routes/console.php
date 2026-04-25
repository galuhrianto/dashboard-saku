<?php

use Illuminate\Support\Facades\Schedule;
use App\Services\PasswordRotationService;

Schedule::call(function () {
    app(PasswordRotationService::class)->handle();
})
->dailyAt('08:00')
->when(fn () => now()->day % 2 === 0);