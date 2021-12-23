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
            $table->string('birthday')->nullable();
            $table->string('known_for_department')->nullable();
            $table->string('deathday')->nullable();
            $table->json('also_known_as')->nullable();
            $table->integer('gender')->nullable();
            $table->longText('biography')->nullable();
            $table->float('popularity')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('profile_path')->nullable();
            $table->string('adult')->nullable();
            $table->string('imdb_id')->nullable();
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
