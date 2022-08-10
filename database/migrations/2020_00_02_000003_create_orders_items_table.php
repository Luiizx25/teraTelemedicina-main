<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_orders_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('finished_at')->nullable()->comment('Data hora da finalizacao');
            //
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('tb_orders');
            //
            $table->integer('id_control')->comment('TIMESTAMP usado para travar duplicação de registros baseados no pressionar F5');
            //
            $table->bigInteger('item_type_id')->unsigned();
            $table->foreign('item_type_id')->references('id')->on('ref_order_item_type');
            //
            $table->bigInteger('item_status_id')->unsigned();
            $table->foreign('item_status_id')->references('id')->on('ref_order_item_status');
            //
            $table->bigInteger('item_status_id_ant')->unsigned()->nullable()->comment('Status que se encontrava ante sdo status atual');
            $table->foreign('item_status_id_ant')->references('id')->on('ref_order_item_status');
            //
            $table->string('item_num')->unique()->comment('Numero do item do pedido');
            //
            $table->bigInteger('item_service_id')->unsigned()->comment('Serviço solicitado baseado na lista do contrato');
            $table->foreign('item_service_id')->references('id')->on('tb_services');
            //
            $table->string('item_comments')->comment('Comentários do Item o Pedido')->nullable();
            //
            $table->dateTime('item_run_datetime')->comment('Data hora da realização');
            $table->text('item_fields')->default('{}')->comment('Campos do serviço prestado');
            //
            $table->dateTime('item_conclusion_datetime')->nullable()->comment('Data hora da conclusão do item');
            //
            $table->unique(['order_id','item_num'], 'uq_orderitem_control');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_orders_items');
    }
}
