<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PHPUnit\Framework\Constraint\Constraint;

class CreateCastMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cast_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cast_id')->constraint();
            $table->foreignId('movie_id')->constraint();
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
        Schema::dropIfExists('cast_movie');
    }
}
