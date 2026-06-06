<?php

use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:check-subscriptions')->daily();

// set every minut in cron job
// /usr/local/bin/php /home/USERNAME/youssi-market/artisan schedule:run >> /dev/null 2>&1
