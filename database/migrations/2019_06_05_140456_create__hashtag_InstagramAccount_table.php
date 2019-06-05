<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagInstagramAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_instagram_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instagram_account_id');
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
        Schema::table('instagram_account_hashtag', function (Blueprint $table) {
            //
        });
    }
}
