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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('slug');
            $table->text('answer');
            $table->unsignedBigInteger('faq_type_id'); // Ajout de la colonne pour la relation
            $table->foreign('faq_type_id')->references('id')->on('faq_types')->onDelete('cascade'); // Relation avec faq_types
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
