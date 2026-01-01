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
    Schema::create('entreprises', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ✅ une seule fois
        $table->string('nom_entreprise');
        $table->string('adresse');
        $table->string('domaine');
        $table->timestamps();
    });


}

    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
