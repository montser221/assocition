<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketers', function (Blueprint $table) {
            $table->id('marketerId');
            $table->string('marketerName')->unique();
            $table->unsignedBigInteger('projectTable');
             $table->foreign('projectTable')
                    ->references('projectId')
                    ->on('projects');
            $table->string('marketerPhone');
            $table->string('marketerEmail')->unique();
            $table->uuid('marketerCode');
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
        Schema::dropIfExists('marketers');
    }
}
