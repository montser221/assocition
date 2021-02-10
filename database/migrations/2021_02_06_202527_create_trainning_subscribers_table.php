<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainningSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainning_subscribers', function (Blueprint $table) {
            $table->id('subscriberId');
            $table->string('subscriberName');
            $table->string('subscriberEmail')->unique();
            $table->string('subscriberPhone')->unique();
            $table->date('subscriberBirthOfDate');
            $table->string('subscriberFamilyCard');
            $table->unsignedBigInteger('trainningCourseId')->default(0);
            $table->foreign('trainningCourseId')
                    ->references('courseId')
                    ->on('trainning_courses');
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
        Schema::dropIfExists('trainning_subscribers');
    }
}
