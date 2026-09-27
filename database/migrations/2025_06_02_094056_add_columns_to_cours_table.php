<?php

use App\Enums\CategorieEnum;
use App\Enums\StatutEnum;
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
         Schema::table('cours', function (Blueprint $table) {
            $table->enum('statut', array_column(StatutEnum::cases(), 'value'))
                  ->default(StatutEnum::pending->value)
                  ->after('description');

            $table->enum('categorie', array_column(CategorieEnum::cases(), 'value'))
                  ->after('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cours', function (Blueprint $table) {
            $table->dropColumn('statut');
            $table->dropColumn('categorie');
        });
    }
};
