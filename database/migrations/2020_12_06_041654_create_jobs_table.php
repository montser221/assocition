<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*
      'fullname','age',
      'email','gender',
      'birthDate','job','cv','phone'
      */
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('jobId');
            $table->string('fullname');
            $table->tinyInteger('age');
            $table->string('email');
            $table->enum('gender',['male','female','unkown']);
            $table->string('job');
            $table->string('phone');
            $table->string('cv');
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
        Schema::dropIfExists('jobs');
    }
}
