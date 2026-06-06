<?php

namespace App\Console\Commands;

use App\Models\Store;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $stores = Store::all();

        foreach ($stores as $store) {
            if (
                $store->trial_ends_at && $now->greaterThan($store->trial_ends_at) &&
                (!$store->subscription_ends_at || $now->greaterThan($store->subscription_ends_at))
            ) {
                // فقط إذا مازال ماشي expired
                if ($store->subscription_status !== 'expired') {
                    $store->subscription_status = 'expired';
                    $store->save();

                    $this->info("Store {$store->id} subscription expired.");
                }else{
                    $this->info('Subscription already expired.');
                }
            }
        }

        $this->info('Subscription check completed.');
    }
}
