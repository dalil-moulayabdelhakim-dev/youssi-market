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
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->string('address');
            $table->string('contact');
            $table->unsignedInteger('subscription_method_id')->default(3);
            $table->date('trial_ends_at')->nullable();
            $table->date('subscription_ends_at')->nullable();
            $table->enum('subscription_status', ['active', 'trial', 'expired'])->default('trial');

            // نسبة العمولة (افتراضياً 3%)
            $table->decimal('commission_rate', 5, 2)->default(3.00);

            $table->timestamps();

            $table->foreign('subscription_method_id')
                ->references('id')
                ->on('subscription_methods')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
