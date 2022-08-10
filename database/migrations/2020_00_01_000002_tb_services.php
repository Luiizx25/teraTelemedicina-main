<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_services', function (Blueprint $table) {
            //
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('customer_sys_id')->unsigned();
            $table->foreign('customer_sys_id')->references('id')->on('tb_customersys');
            //
            $table->string('service_name');
            $table->string('service_description')->nullable();
            //
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('ref_service_category')->nullable();
            //
            $table->boolean('active')->default(1);
            //
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_service_type');
            //
            $table->string('service_code')->nullable()->comment('Código interno do serviço');
            $table->string('service_code_universal')->nullable()->comment('Código usado de forma universal ao serviço');
            //
            $table->decimal('service_price')->default(0.00)->comment('Valor do Serviço');
            $table->decimal('service_price_over')->default(0.00)->comment('Valor do Serviço Excedente');
            $table->string('service_time_estimated')->default('00:00');
            $table->string('service_slug')->nullable();
            //
            $table->decimal('service_pvd_price')->default(0.00)->comment('Valor do Serviço');
            $table->decimal('service_pvd_price_over')->default(0.00)->comment('Valor do Serviço Excedente');
            $table->string('service_pvd_time_estimated')->default('00:00');
            //
            $table->unique(['customer_sys_id','service_name'], 'uq_service_csys_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_services');
    }
}
