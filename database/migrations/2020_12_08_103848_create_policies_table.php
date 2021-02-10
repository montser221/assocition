<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('policies', function (Blueprint $table) {
            $table->id('policyId');
            $table->string('policyTitle');
            $table->string('policyLevel');
            $table->string('policyImage')->nullable();
            $table->string('policyFile')->nullable();
            $table->string('policyText')->nullable();
            $table->tinyInteger('showInHome')->default(0);
            $table->tinyInteger('policyStatus')->default(0);
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
        Schema::dropIfExists('policies');
    }
}
