<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id('settingId');
            $table->string('foundationName');
            $table->string('foundationTitle');
            $table->string('email');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('phoneNumber');
            $table->string('fax')->nullable();
            $table->string('foundationLogo')->nullable();
            $table->tinyInteger('siteStatus')->default(0);
            $table->tinyInteger('jobsStatus')->default(0);
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
