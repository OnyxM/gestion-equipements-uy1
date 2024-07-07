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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('delegue_id')->unsigned(); // user avec role delegue
            $table->integer('manager_id')->unsigned()->nullable(); // user avec role manager
            $table->integer('equipement_id')->unsigned();
            $table->date('date');
            $table->integer('debut');
            $table->integer('fin')->nullable();
            $table->text('commentaire')->nullable();
            /**
             * pending => réservation créée
             * rejected => rejetée par le manager...
             * accepted => ... !
             * ended => le délégué est venur récupérer l'équipement
             */
            $table->enum('status', ['pending', 'rejected', 'accepted', 'ended'])->default('pending');
//            $table->foreign('delegue_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('equipement_id')->references('id')->on('equipements')->onDelete('cascade');
//            $table->softDeletes(); // permet de supprimer une réservation sans supprimer le champ deleted_at qui stocke la date de suppression
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
