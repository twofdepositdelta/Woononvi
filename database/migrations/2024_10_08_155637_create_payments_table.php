<?php

use App\Models\Booking;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string('reference');
            $table->string('payment_number')->nullable();
            $table->enum('payment_method', ['CREDITCARD', 'PAYPAL', 'CASH', 'MOMO'])->default('MOMO');
            $table->enum('status', ['PENDING', 'SUCCESSFUL', 'FAILED'])->default('PENDING');
            $table->foreignIdFor(Booking::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(PaymentType::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};