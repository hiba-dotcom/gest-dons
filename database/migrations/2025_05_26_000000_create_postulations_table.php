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
        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('president_id');
            $table->foreign('president_id')->references('id')->on('users');
            $table->text('experiences');
            $table->text('motivations');
            $table->text('plan');
            $table->enum('statut' , ['pending' , 'validé' , 'refusé'])->default('pending');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulations');
    }
};
