<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContractsServices1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contracts_cus_services', function (Blueprint $table) {
            //
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('tb_contracts_customers');
            //
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('tb_services');
            //
            $table->boolean('active')->default(1);
            //
            $table->integer('service_negotiated_amount')->default(0);
            $table->decimal('service_negotiated_price')->default(0.00)->comment('Valor do Serviço');
            $table->decimal('service_negotiated_price_over')->default(0.00)->comment('Valor do Serviço Excedente');
            $table->string('service_negotiated_time_estimated')->default('00:00');
            //
            $table->string('service_negotiated_comments')->nullable();
            //
            $table->unique(['contract_id','service_id'], 'uq_cus_contract_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_contracts_cus_services');
    }
}
