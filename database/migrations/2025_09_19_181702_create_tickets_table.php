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
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable(); // صاحب التذكرة (المريض/الزبون)
            $table->unsignedInteger('admin_id')->nullable(); // صاحب التذكرة (المريض/الزبون)
            $table->string('subject'); // عنوان التذكرة
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('admin_id')->references('id')->on('users')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
