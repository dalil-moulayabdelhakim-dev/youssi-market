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
        Schema::create('store_wilayas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('wilaya_id');
            $table->decimal('price_to_home', 8, 2)->nullable();
            $table->decimal('price_to_office', 8, 2)->nullable();
            $table->timestamps();

            $table->unique(['store_id', 'wilaya_id']);

            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
            $table->foreign('wilaya_id')->references('id')->on('wilayas')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_wilayas');
    }
};
