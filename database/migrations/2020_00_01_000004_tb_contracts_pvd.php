<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContractsPvd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contracts_providers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('tb_providers');
            //
            $table->bigInteger('contract_previous_id')->unsigned()->nullable()->comment('Contrato Anterior referencia se houver');
            $table->foreign('contract_previous_id')->references('id')->on('tb_contracts_providers');
            //
            $table->boolean('active')->default(1);
            //
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_contract_pvd_type');
            //
            $table->string('contract_num')->nullable();
            //
            $table->date('contract_date')->comment('Data do Contrato');
            $table->date('contract_date_start')->nullable()->comment('Data início do Contrato');
            $table->date('contract_date_end')->nullable()->comment('Data término do Contrato');
            //
            $table->string('contract_comments')->nullable()->comment('Comentários');
            //
            $table->integer('payment_day');
            $table->bigInteger('payment_option_id')->unsigned();
            $table->foreign('payment_option_id')->references('id')->on('ref_payment_pvd_option');
            $table->boolean('payment_productivity')->default(false)->comment('Contrato por Produtividade');
            $table->boolean('payment_oncall')->default(false)->comment('Contrato por Plantão');
            $table->decimal('payment_oncall_price_hour')->default(0.00)->comment('Valor da Hora');
            $table->decimal('payment_oncall_price_daily')->default(0.00)->comment('Valor da Diária');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_contracts_providers');
    }
}
