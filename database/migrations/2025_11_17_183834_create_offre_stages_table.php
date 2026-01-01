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
    Schema::create('offre_stages', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('entreprise_id'); // L'entreprise qui a créé l'offre

        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('duree')->nullable(); // exemple : "3 mois"
        $table->string('lieu')->nullable();
        $table->string('type')->default('Stage'); // Stage/PFE/emploi

        $table->timestamps();

        // clé étrangère
        $table->foreign('entreprise_id')
              ->references('id')
              ->on('entreprises')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_stages');
    }
};
