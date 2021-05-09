<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pokemon_types')) {
            Schema::create('pokemon_types', function (Blueprint $table) {
                $table->primary(['pokemon_id', 'types_id']);
                $table->bigInteger('pokemon_id')->unsigned();
                $table->bigInteger('types_id')->unsigned();
                $table->timestamps();
                $table->foreign('pokemon_id')
                    ->references('id')->on('pokemon');
                $table->foreign('types_id')
                    ->references('id')->on('types');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_types');
    }
}
