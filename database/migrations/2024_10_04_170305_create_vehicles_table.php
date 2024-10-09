<?php

use App\Models\TypeVehicle;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('licence_plate')->nullable();
            $table->string('vehicle_mark')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->integer('vehicle_year');
            $table->integer('seats')->default(1);
            $table->string('logbook');
            $table->string('color');
            $table->string('main_image');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(TypeVehicle::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};