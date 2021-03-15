<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonalPhotoAndCvToVoluntaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->string('personalPhoto')->nullable();
            $table->string('cv')->nullable();
            $table->text('typeOfService')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->dropColumn(['personalPhoto','cv','typeOfService']);
        });
    }
}
