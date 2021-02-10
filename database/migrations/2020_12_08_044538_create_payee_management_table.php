<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayeeManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payee_management', function (Blueprint $table) {
            $table->id('pId');
            $table->string('pName');
            $table->string('healthState');
            $table->string('ssnNumber');
            // $table->string('pImage')->nullable();
            $table->enum('gender',['male','female']);
            $table->tinyInteger('pStatus')->default(0);
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
        Schema::dropIfExists('payee_management');
    }
}
