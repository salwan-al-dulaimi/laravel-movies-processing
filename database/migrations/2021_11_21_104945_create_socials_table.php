<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->constraint();
            $table->string('imdb_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('freebase_mid')->nullable();
            $table->string('freebase_id')->nullable();
            $table->string('tvrage_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('instagram_id')->nullable();
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
        Schema::dropIfExists('socials');
    }
}
