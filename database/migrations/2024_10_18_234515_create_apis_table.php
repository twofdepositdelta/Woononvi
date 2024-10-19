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
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('maps')->nullable();
            $table->string('feedpay_public')->nullable();
            $table->string('feedpay_private')->nullable();
            $table->string('feedpay_secret')->nullable();
            $table->string('kkiapay_public')->nullable();
            $table->string('kkiapay_private')->nullable();
            $table->string('kkiapay_secret')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apis');
    }
};
