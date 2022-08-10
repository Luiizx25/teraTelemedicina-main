<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContractsServices3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contracts_cus_cycles_services', function (Blueprint $table) {
            //
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('cycle_id')->unsigned();
            $table->foreign('cycle_id')->references('id')->on('tb_contracts_cus_cycles');
            //
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('tb_services');
            //
            $table->decimal('cycle_negotiated_price')->default(0.00)->comment('Valor do Serviço');
            $table->decimal('cycle_negotiated_price_over')->default(0.00)->comment('Valor do Serviço Excedente');
            $table->integer('cycle_amount_negotiated')->default(0);
            $table->integer('cycle_amount_available')->default(0);
            $table->integer('cycle_amount_used')->default(0);
            //
            $table->string('cycle_time_estimated')->default('00:00');
            //
            $table->unique(['cycle_id','service_id'], 'uq_cus_cycle_cycle_service');
        });
    }
}
