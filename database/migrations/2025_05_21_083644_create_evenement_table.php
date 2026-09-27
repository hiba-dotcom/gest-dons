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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->float('budget');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->unsignedBigInteger('lieu_id');
            $table->foreign('lieu_id')->references('id')->on('adresses');
            $table->unsignedBigInteger('association_id');
            $table->foreign('association_id')->references('id')->on('associations');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenement');
    }
};
