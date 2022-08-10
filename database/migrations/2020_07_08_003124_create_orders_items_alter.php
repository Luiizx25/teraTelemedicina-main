<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsAlter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_orders_items', function (Blueprint $table) {
            //
            $table->dateTime('item_start_datetime')->nullable()->comment('Data hora da Inicio do Report');
            $table->dateTime('item_end_datetime')->nullable()->comment('Data hora da Fim do Report');
            //
            $table->bigInteger('item_conclusion_provider_id')->unsigned()->nullable();
            $table->foreign('item_conclusion_provider_id')->references('id')->on('tb_providers');
            //
            $table->bigInteger('item_conclusion_report_id')->unsigned()->nullable();
            $table->foreign('item_conclusion_report_id')->references('id')->on('tb_orders_items_reports');
            //
            $table->decimal('item_conclusion_price')->nullable()->comment('Valor final do Serviço');
            $table->string('item_conclusion_comment')->nullable();
        });
    }
}
