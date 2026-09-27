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
        Schema::create('mosquees', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('image')->nullable();
            $table->foreignId('chef_id')->nullable()->constrained('users');
            $table->unsignedBigInteger('adresse_id');
            $table->foreign('adresse_id')->references('id')->on('mosquee_adresses')->onDelete('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mosquees');
    }
};
