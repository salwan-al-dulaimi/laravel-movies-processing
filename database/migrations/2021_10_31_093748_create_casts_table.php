<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casts', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult');
            $table->integer('gender');
            $table->string('known_for_department');
            $table->string('name');
            $table->string('original_name');
            $table->float('popularity');
            $table->string('profile_path')->nullable();
            $table->integer('cast_id');
            $table->string('character');
            $table->string('credit_id');
            $table->integer('order');
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
        Schema::dropIfExists('casts');
    }
}
