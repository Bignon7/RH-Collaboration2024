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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //Les informations personnelles
            $table->string('matricule');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('adresse');
            //Les informations administratives
            $table->string('hire_date');
            $table->string('poste');
            $table->string('service');
            $table->string('role')->default('Employé');
            $table->string('comp_file');
            $table->string('photo_file');
            $table->string('password');
            $table->string('salaire')->nullable();
            $table->string('lien_contrat')->nullable();
            $table->string('duree_contrat')->nullable();
            $table->string('total_conges')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
