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
        Schema::create('demandeconges', function (Blueprint $table) {
            $table->id();
            $table->string('type_conge');
            $table->string('date_debut_conge');
            $table->string('duree_conge');
            $table->text('motif_conge');
            $table->enum('statut_conge', ['Approuvée', 'Rejetée'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandeconges');
    }
};
