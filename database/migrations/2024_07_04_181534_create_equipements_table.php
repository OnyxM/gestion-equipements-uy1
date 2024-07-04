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
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string("code")->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum("status", ['free', 'busy'])->default('free');
            $table->integer('created_by')->unsigned(); // le user qui a ajouté l'équipement dans le système
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
