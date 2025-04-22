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
        Schema::create('kilometrages', function (Blueprint $table) {
            $table->id();
            $table->integer('min_km');
            $table->integer('max_km');
            $table->integer('taux_par_km'); // en FCFA
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kilometrages');
    }
};
