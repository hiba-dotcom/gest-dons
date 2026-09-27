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
        Schema::create('mosquee_adresses', function (Blueprint $table) {
            $table->id(); // Crée un BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('boulevard');
            $table->string('ville');
            $table->string('pays');
            $table->timestamps();
            $table->engine = 'InnoDB'; // Explicitement défini
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mosquee_adresses');
    }
};
