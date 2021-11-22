<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('birthday');
            $table->string('known_for_department');
            $table->string('deathday')->nullable();
            $table->json('also_known_as');
            $table->integer('gender');
            $table->longText('biography');
            $table->float('popularity');
            $table->string('place_of_birth');
            $table->string('adult');
            $table->string('imdb_id');
            $table->string('homepage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
