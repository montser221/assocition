<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePayeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payees', function (Blueprint $table) {
          $table->id('payeeId');
          $table->string('firstName');
          $table->string('fatherName');
          $table->string('grandFatherName');
          $table->string('lastName');
          $table->enum('socialState',['married','unmarried','unkown']);
          $table->string('natonality');
          $table->string('ssnNumber');
          $table->string('email');
          $table->enum('gender',['male','female','unkown']);
          $table->string('bestContactTime');
          $table->date('birthDate');
          $table->string('jobTitle');
          $table->string('jobEmployer');
          $table->string('address');
          $table->string('phone');
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
        Schema::dropIfExists('payees');
    }
}
