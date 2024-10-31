<?php

use App\Models\TypeNew;
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
        Schema::create('actualities', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug');
            $table->text('description');
            $table->string('image_url');
            $table->boolean('published')->default(true);
            $table->foreignIdFor(TypeNew::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualities');
    }
};
