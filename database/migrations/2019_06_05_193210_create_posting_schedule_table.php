<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostingScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posting_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('post_at');
            $table->unsignedBigInteger('post_id')->unique();
            $table->boolean('posted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posting_schedule');
    }
}
