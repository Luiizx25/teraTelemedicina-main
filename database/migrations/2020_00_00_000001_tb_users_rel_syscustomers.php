<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbUsersRelSyscustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_customersys_users', function (Blueprint $table) {
            //
            $table->bigInteger('customer_sys_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            //Create a Unique Constraint
            $table->unique(['customer_sys_id','user_id'], 'uq_customersys_users');

            //Create Foreign Keys
            $table->foreign('customer_sys_id')->references('id')->on('tb_customersys')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_customersys_users');
    }
}
