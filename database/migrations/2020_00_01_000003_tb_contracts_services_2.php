<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContractsServices2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contracts_cus_cycles', function (Blueprint $table) {
            //
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('tb_contracts_customers');
            //
            $table->string('cycle_slug');
            $table->string('cycle_year');
            $table->string('cycle_month');
            $table->date('cycle_date_start');
            $table->date('cycle_date_end');
            //
            $table->unique(['contract_id','cycle_slug'], 'uq_cus_cycle_contract_cycle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_contracts_cus_cycles');
    }
}
