<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constraint();
            $table->string('iso_639_1')->nullable();
            $table->string('iso_3166_1')->nullable();
            $table->string('name')->nullable();
            $table->string('key')->nullable();
            $table->string('site')->nullable();
            $table->integer('size')->nullable();
            $table->string('type')->nullable();
            $table->boolean('official')->nullable();
            $table->string('published_at')->nullable();

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
        Schema::dropIfExists('videos');
    }
}
