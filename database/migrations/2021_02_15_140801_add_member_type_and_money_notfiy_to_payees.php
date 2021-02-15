<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberTypeAndMoneyNotfiyToPayees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payees', function (Blueprint $table) {
            $table->string('moneyNotify')->nullable();
            $table->enum('memberType',['volnteerMember','commonMember'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payees', function (Blueprint $table) {
            $table->dropColumn(['moneyNotify','memberType']);
        });
    }
}
