<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        // 'arrowName','arrowValue','created_at','updated_at'
        Schema::create('arrows', function (Blueprint $table) {
            $table->id('arrowId');
            $table->string('arrowName');
            $table->integer('arrowValue')->nullable();
            $table->unsignedBigInteger('projectTable');
            $table->foreign('projectTable')->references('projectId')->on('projects');
            $table->tinyInteger('arrowStatus')->default(0);
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
        Schema::dropIfExists('arrows');
    }
}
