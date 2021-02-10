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
      /*
      VideoId
  videoTitle
  videoLink
  videoStatus
      */
        Schema::create('videos', function (Blueprint $table) {
            $table->id('videoId');
            $table->string('videoTitle')->nullable();
            $table->string('videoIcon')->nullable();
            $table->string('videoLink')->nullable();
            $table->tinyInteger('videoStatus')->default(0);
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
