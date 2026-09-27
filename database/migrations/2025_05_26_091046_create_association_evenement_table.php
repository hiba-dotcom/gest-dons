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
        Schema::create('association_evenement', function (Blueprint $table) {
            $table->unsignedBigInteger('association_id');
            $table->unsignedBigInteger('evenement_id');
            $table->primary(['association_id', 'evenement_id']);
            $table->foreign('association_id')->references('id')->on('associations');
            $table->foreign('evenement_id')->references('id')->on('evenements');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('association_evenement');
    }
};
