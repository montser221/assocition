<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_views', function (Blueprint $table) {
            $table->id('pageViewsId');
            $table->ipAddress('visitorIp');
            $table->unsignedBigInteger('pagesTable');
            $table->foreign('pagesTable')
                    ->references('pageId')
                    ->on('pages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('pages_views');
    }
}
