<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscription_methods', function (Blueprint $table) {
            if (Schema::hasColumn('subscription_methods', 'duration_months')) {
                $table->renameColumn('duration_months', 'duration_days');
            } else if (!Schema::hasColumn('subscription_methods', 'duration_days')) {
                $table->integer('duration_days')->nullable()->after('price');
            }
        });

        // Convert months to days for existing data (assuming 30 days per month)
        DB::table('subscription_methods')->where('name', 'monthly')->update(['duration_days' => 30]);
        DB::table('subscription_methods')->where('name', 'yearly')->update(['duration_days' => 365]);
        DB::table('subscription_methods')->where('name', 'trial')->update(['duration_days' => 30]);
        DB::table('subscription_methods')->where('name', 'lifetime')->update(['duration_days' => 36500]); // 100 years
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_methods', function (Blueprint $table) {
            if (Schema::hasColumn('subscription_methods', 'duration_days')) {
                $table->renameColumn('duration_days', 'duration_months');
            }
        });
    }
};
