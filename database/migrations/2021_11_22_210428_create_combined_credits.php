<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombinedCredits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combined_credits', function (Blueprint $table) {
            $table->id();

            $table->integer('people_id');
            $table->string('title');
            $table->string('media_type');
            $table->string('poster_path')->nullable();
            $table->string('release_date')->nullable();
            $table->string('character')->nullable();
           
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
        Schema::dropIfExists('combined_credits');
    }
}
