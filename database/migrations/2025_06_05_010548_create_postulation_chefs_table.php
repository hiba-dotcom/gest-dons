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
        Schema::create('postulation_chefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('users')->onDelete('cascade'); // l'adhérent
            $table->foreignId('mosquee_id')->constrained('mosquees')->onDelete('cascade'); // la mosquée demandée
            $table->enum('statut', ['en_attente', 'validé', 'refusé'])->default('en_attente');
            $table->text('motivations');
            $table->text('experiences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulation_chefs');
    }
};
