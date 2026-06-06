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
        Schema::create('communes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ar_name');
            $table->unsignedInteger('daira_id');
            $table->foreign('daira_id')->references('id')->on('dairas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
