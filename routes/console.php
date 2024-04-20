<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:import-horoscopes-command')->everyFiveSeconds();
Schedule::command('app:add-pending-horoscope-translations-command')->everyMinute();
Schedule::command('app:translate-horoscopes-command')->everyTwoMinutes();
