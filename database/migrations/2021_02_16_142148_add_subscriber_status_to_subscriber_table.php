<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriberStatusToSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainning_subscribers', function (Blueprint $table) {
            $table->unsignedTinyInteger('subscriberStatus')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainning_subscribers', function (Blueprint $table) {
            $table->dropColumn(['subscriberStatus']);
        });
    }
}
