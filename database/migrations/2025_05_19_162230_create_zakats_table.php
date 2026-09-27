<?php

use App\Enums\StatutEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zakats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            // Payment information
            $table->string('reference')->unique();
            $table->decimal('montant', 10, 2); 
            $table->string('payment_method')->default('card'); 
            $table->enum('status' , array_column(StatutEnum::cases(), 'value')); 
            $table->string('purpose')->nullable(); 
            // Payment details
            $table->string('receipt_path')->nullable();
            $table->json('metadata')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign key (user only)
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->engine = 'InnoDB';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zakats');
    }
};