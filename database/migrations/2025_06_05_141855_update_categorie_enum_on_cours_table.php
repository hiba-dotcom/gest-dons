<?php

use App\Enums\CategorieEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategorieEnumOnCoursTable extends Migration
{
    public function up()
    {
        Schema::table('cours', function (Blueprint $table) {
            $table->enum('categorie', array_column(CategorieEnum::cases(), 'value'))->change();
        });
    }

    public function down()
    {
        Schema::table('cours', function (Blueprint $table) {
            $table->enum('categorie', array_column(CategorieEnum::cases(), 'value'))->change();
        });
    }
}
