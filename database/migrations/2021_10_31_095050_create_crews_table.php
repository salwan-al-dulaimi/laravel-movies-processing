<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crews', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult');
            $table->integer('gender');
            $table->string('known_for_department');
            $table->string('name');
            $table->string('original_name');
            $table->float('popularity');
            $table->string('profile_path')->nullable();
            $table->string('credit_id');
            $table->string('department');
            $table->string('job');
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
        Schema::dropIfExists('crews');
    }
}
