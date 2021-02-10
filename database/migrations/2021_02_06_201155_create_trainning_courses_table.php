<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainningCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainning_courses', function (Blueprint $table) {
            $table->id('courseId');
            $table->string('courseName');
            $table->string('courseDescription',255);
            $table->string('courseLocation');
            $table->text('courseContent');
            $table->string('courseImage')->nullable();
            $table->string('courseInstructor')->nullable();
            $table->enum('coursePrice',['free','paid'])->default('free');
            $table->enum('courseState',['expired','starting','notStarting'])->default('starting');
            $table->date('courseDate')->nullable();
            $table->time('courseTime')->nullable();
            $table->unsignedInteger('seatCount')->default(0);
            $table->unsignedInteger('courseStatus')->default(0);
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
        Schema::dropIfExists('trainning_courses');
    }
}
