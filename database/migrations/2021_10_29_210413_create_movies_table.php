<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->integer('budget')->nullable();
            $table->json('genres')->nullable();
            $table->string('homepage')->nullable();
            $table->string('imdb_id')->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title')->nullable();
            $table->text('overview')->nullable();
            $table->float('popularity')->nullable();
            $table->string('poster_path')->nullable();
            $table->json('production_companies')->nullable();
            $table->json('production_countries')->nullable();
            $table->string('release_date')->nullable();
            $table->integer('revenue')->nullable();
            $table->integer('runtime')->nullable();
            $table->json('spoken_languages')->nullable();
            $table->string('status')->nullable();
            $table->string('tagline')->nullable();
            $table->string('title')->nullable();
            $table->boolean('video')->nullable();
            $table->float('vote_average')->nullable();
            $table->integer('vote_count')->nullable();

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
        Schema::dropIfExists('movies');
    }
}
