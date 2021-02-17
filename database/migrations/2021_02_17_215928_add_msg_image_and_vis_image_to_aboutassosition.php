<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMsgImageAndVisImageToAboutassosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_associations', function (Blueprint $table) {
            $table->string('visonImage')->nullable();
            $table->string('messageImage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_associations', function (Blueprint $table) {
            $table->dropColumn(['visonImage','messageImage']);
        });
    }
}
