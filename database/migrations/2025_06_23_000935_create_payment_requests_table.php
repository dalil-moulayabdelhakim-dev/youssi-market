<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id');
            $table->string('proof_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedInteger('subscription_method_id');
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
            $table->foreign('subscription_method_id')->references('id')->on('subscription_methods')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_requests');
    }
};
