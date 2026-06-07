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
            if (!Schema::hasColumn('subscription_methods', 'duration_months')) {
                $table->integer('duration_months')->nullable()->after('price');
            }
        });

        // Update existing methods
        DB::table('subscription_methods')->where('name', 'monthly')->update(['duration_months' => 1]);
        DB::table('subscription_methods')->where('name', 'yearly')->update(['duration_months' => 12]);
        DB::table('subscription_methods')->where('name', 'trial')->update(['duration_months' => 1]);

        // Add lifetime method if not exists
        if (!DB::table('subscription_methods')->where('name', 'lifetime')->exists()) {
            DB::table('subscription_methods')->insert([
                'name' => 'lifetime',
                'price' => '0', // Manual/Special price
                'duration_months' => 1200, // 100 years
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_methods', function (Blueprint $table) {
            $table->dropColumn('duration_months');
        });
        
        DB::table('subscription_methods')->where('name', 'lifetime')->delete();
    }
};
