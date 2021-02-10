<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_associations', function (Blueprint $table) {
            $table->id('associationId');
            $table->string('associationTitle');
            $table->string('managerName');
            $table->text('managerWord');
            $table->text('vison');
            $table->text('message');
            $table->string('associationIcon')->nullable();
            $table->string('visonIcon')->nullable();
            $table->string('messageIcon')->nullable();
            $table->tinyInteger('associationStatus')->default(0);
            $table->tinyInteger('showInHome')->default(0);
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
        Schema::dropIfExists('about_associations');
    }
}
