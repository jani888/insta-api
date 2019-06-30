<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagInstagramPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_instagram_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instagram_post_id');
            $table->unsignedBigInteger('hashtag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_post_hashtag_');
    }
}
