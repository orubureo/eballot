<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SyncElectionStatuses;
use Illuminate\Support\Facades\Schedule;

Schedule::command(SyncElectionStatuses::class)->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
