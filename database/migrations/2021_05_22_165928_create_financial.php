<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_financial', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->bigInteger('contract_cycle_id')->unsigned();
            $table->foreign('contract_cycle_id')->references('id')->on('tb_contracts_cus_cycles');

            $table->dateTime('financial_cycle')->nullable()->comment('Mês do faturamento');
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();

            $table->string('order_num')->comment('Número do pedido Gerado pelo sistema');
            $table->string('order_num_cus')->nullable()->comment('Número do pedido oriundo do cliente');
            $table->string('order_comments')->nullable()->comment('Comentários do pedido');
            $table->string('order_description')->nullable();
            //
            
            //INFORMÇÕES DO PACIENTE
            $table->bigInteger('patient_id')->unsigned()->comment('Cadastro do Paciente');
            $table->string('pat_name');

            //ORDER ITEM
            $table->bigInteger('order_item_id')->unsigned();
            $table->dateTime('finished_at')->nullable()->comment('Data hora da finalizacao');
            //
            $table->integer('id_control_item')->comment('TIMESTAMP usado para travar duplicação de registros baseados no pressionar F5');
            //
            $table->bigInteger('item_type_id')->unsigned();
            //
            $table->bigInteger('item_status_id')->unsigned();
            //
            $table->bigInteger('item_service_id')->unsigned()->comment('Serviço solicitado baseado na lista do contrato');
            $table->string('service_name')->comment('Nome do Serviço')->nullable();
            //
            $table->dateTime('item_run_datetime')->comment('Data hora da realização');
            $table->text('item_fields')->default('{}')->comment('Campos do serviço prestado');
            //
            $table->dateTime('item_conclusion_datetime')->nullable()->comment('Data hora da conclusão do item');
            //
            $table->dateTime('item_start_datetime')->nullable()->comment('Data hora da Inicio do Report');
            $table->dateTime('item_end_datetime')->nullable()->comment('Data hora da Fim do Report');
            //
            $table->bigInteger('item_conclusion_provider_id')->nullable();
            //
            $table->bigInteger('item_conclusion_report_id')->nullable();
            //
            $table->decimal('item_conclusion_price')->nullable()->comment('Valor final do Serviço');
            $table->string('item_conclusion_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_financial');
    }
}
