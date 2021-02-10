<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenoatePayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denoate_pay_details', function (Blueprint $table) {
            $table->id('denoateId');
            $table->string('denoatePhone');
            $table->string('denoateName')->nullable();
            $table->unsignedBigInteger('projectTable');
            $table->foreign('projectTable')->references('projectId')->on('projects');
            $table->unsignedBigInteger('paymentMethodTable');
            $table->foreign('paymentMethodTable')->references('methodId')->on('payment_methods');
            $table->unsignedBigInteger('moneyValue');
            $table->tinyInteger('denoateStatus')->nullable();
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
        Schema::dropIfExists('denoate_pay_details');
    }
}
