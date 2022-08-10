<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('tb_customers');
            //
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //
            $table->bigInteger('contract_cycle_id')->unsigned();
            $table->foreign('contract_cycle_id')->references('id')->on('tb_contracts_cus_cycles');
            //
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('ref_order_status');
            //
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_order_type');
            //
            $table->integer('id_control')->comment('TIMESTAMP usado para travar duplicação de registros baseados no pressionar F5');
            $table->string('order_num')->comment('Número do pedido Gerado pelo sistema');
            $table->string('order_num_cus')->nullable()->comment('Número do pedido oriundo do cliente');
            $table->string('order_comments')->nullable()->comment('Comentários do pedido');
            $table->string('order_description')->nullable();
            $table->decimal('order_price',5,2)->nullable()->comment('Valor total do Pedido');
            //
            $table->unique(['customer_id','id_control'], 'uq_order_control');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_orders');
    }
}
