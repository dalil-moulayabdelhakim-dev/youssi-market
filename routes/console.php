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

/**
 * Release matured escrow funds to sellers daily.
 * Funds move from holding_balance to withdrawable_balance after the escrow period.
 */
Schedule::call(function () {
    \Illuminate\Support\Facades\DB::transaction(function () {
        $matured = \App\Models\Commission::where('financial_status', 'holding')
            ->where('release_at', '<=', now())
            ->get();

        foreach ($matured as $commission) {
            $store = $commission->store;
            if ($store) {
                // Atomic transfer of funds
                $store->decrement('holding_balance', $commission->amount);
                $store->increment('withdrawable_balance', $commission->amount);

                $commission->update(['financial_status' => 'released']);
            }
        }
    });
})->daily()->name('release-escrow-funds');

// set every minut in cron job
// /usr/local/bin/php /home/USERNAME/youssi-market/artisan schedule:run >> /dev/null 2>&1
