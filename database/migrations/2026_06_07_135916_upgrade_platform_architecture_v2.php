<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Issue 2: Escrow Balances for Stores
        Schema::table('stores', function (Blueprint $table) {
            if (!Schema::hasColumn('stores', 'holding_balance')) {
                $table->decimal('holding_balance', 12, 2)->default(0)->after('subscription_status');
            }
            if (!Schema::hasColumn('stores', 'withdrawable_balance')) {
                $table->decimal('withdrawable_balance', 12, 2)->default(0)->after('holding_balance');
            }
        });

        // Issue 2: Escrow Ledger for Commissions
        Schema::table('commissions', function (Blueprint $table) {
            if (!Schema::hasColumn('commissions', 'release_at')) {
                $table->timestamp('release_at')->nullable()->after('amount');
            }
            if (!Schema::hasColumn('commissions', 'financial_status')) {
                $table->enum('financial_status', ['holding', 'released', 'cancelled'])->default('holding')->after('release_at');
            }
        });

        // Issue 3: Anti-Forgery & Grace Period for Payments
        Schema::table('payment_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_requests', 'transaction_reference')) {
                $table->string('transaction_reference', 100)->nullable()->unique()->after('subscription_method_id');
            }
            if (!Schema::hasColumn('payment_requests', 'grace_period_ends_at')) {
                $table->timestamp('grace_period_ends_at')->nullable()->after('status');
            }
        });

        // Issue 4: Product Weight
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'weight')) {
                $table->decimal('weight', 8, 2)->default(1.00)->comment('Weight in KG')->after('price');
            }
        });

        // Issue 4: Dynamic Shipping Matrix
        Schema::table('store_wilayas', function (Blueprint $table) {
            if (!Schema::hasColumn('store_wilayas', 'base_weight')) {
                $table->decimal('base_weight', 5, 2)->default(5.00)->comment('Included kg before extra charges')->after('wilaya_id');
            }
            if (!Schema::hasColumn('store_wilayas', 'extra_price_per_kg_home')) {
                $table->decimal('extra_price_per_kg_home', 8, 2)->default(0)->after('price_to_home');
            }
            if (!Schema::hasColumn('store_wilayas', 'extra_price_per_kg_office')) {
                $table->decimal('extra_price_per_kg_office', 8, 2)->default(0)->after('price_to_office');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn(['holding_balance', 'withdrawable_balance']);
        });

        Schema::table('commissions', function (Blueprint $table) {
            $table->dropColumn(['release_at', 'financial_status']);
        });

        Schema::table('payment_requests', function (Blueprint $table) {
            $table->dropColumn(['transaction_reference', 'grace_period_ends_at']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('weight');
        });

        Schema::table('store_wilayas', function (Blueprint $table) {
            $table->dropColumn(['base_weight', 'extra_price_per_kg_home', 'extra_price_per_kg_office']);
        });
    }
};
