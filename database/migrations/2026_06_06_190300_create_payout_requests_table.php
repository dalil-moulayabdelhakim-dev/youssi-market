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
        if (!Schema::hasTable('payout_requests')) {
            Schema::create('payout_requests', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('store_id');
                $table->decimal('amount', 10, 2);
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->text('bank_details');
                $table->text('admin_notes')->nullable();
                $table->timestamps();

                $table->foreign('store_id')
                    ->references('id')
                    ->on('stores')
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payout_requests');
    }
};
