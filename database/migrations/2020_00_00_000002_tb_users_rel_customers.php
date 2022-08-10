<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbUsersRelCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_customers_users', function (Blueprint $table) {
            //
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('manager')->default(false);
            $table->boolean('financial')->default(false);
            $table->boolean('tecnical')->default(false);

            //Create a Unique Constraint
            $table->unique(['customer_id','user_id'], 'uq_customers_users');

            //Create Foreign Keys
            $table->foreign('customer_id')->references('id')->on('tb_customers')->onDelete('cascade');
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
        Schema::dropIfExists('tb_customers_users');
    }
}
