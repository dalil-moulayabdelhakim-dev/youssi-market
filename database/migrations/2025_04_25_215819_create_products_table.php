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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['product', 'service'])->default('product');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('store_id');
            $table->string('quantity');
            $table->string('price');
            $table->string('discount_price');
            $table->string('old_price');
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
