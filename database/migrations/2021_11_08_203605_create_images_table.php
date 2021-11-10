<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constraint();
            $table->float('aspect_ratio')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('height')->nullable();
            $table->string('iso_639_1')->nullable();
            $table->integer('vote_average')->nullable();
            $table->integer('vote_count')->nullable();
            $table->integer('width')->nullable();
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
        Schema::dropIfExists('images');
    }
}
