<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable(); // pour entreprise ou étudiant
        $table->string('prenom')->nullable(); // pour étudiant
        $table->string('email')->unique();
        $table->string('password');
        $table->string('role'); // 'etudiant' ou 'entreprise'

        // Champs spécifiques aux étudiants
        $table->string('cin')->nullable();
        $table->date('date_naissance')->nullable();
        $table->string('classe')->nullable();

        // Champs spécifiques aux entreprises
        $table->string('nom_entreprise')->nullable();
        $table->string('adresse')->nullable();
        $table->string('domaine')->nullable();

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
