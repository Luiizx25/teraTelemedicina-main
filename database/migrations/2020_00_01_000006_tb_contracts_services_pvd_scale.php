<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContractsServicesPvdScale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contracts_pvd_scales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('tb_contracts_providers');
            //
            $table->bigInteger('scale_previos_id')->unsigned();
            $table->foreign('scale_previos_id')->references('id')->on('tb_contracts_pvd_scales');
            //
            $table->bigInteger('scale_type_id')->unsigned()->comment('Tipo da Escala');
            $table->foreign('scale_type_id')->references('id')->on('ref_contract_pvd_scale_type');
            //
            $table->text('services_available')->default('{}')->comment('Json com os IDs dos Serviços disponiveis na Escala');
            //
            $table->bigInteger('scale_week_day_id')->unsigned()->nullable()->comment('Dia da Semana');
            $table->foreign('scale_week_day_id')->references('id')->on('list_week_day');
            //
            $table->string('scale_time_start')->comment('Hora de Inicio')->default('00:00');
            $table->string('scale_time_end')->comment('Hora de Término')->default('00:00');
            //
            $table->integer('scale_service_amount_max')->nullable()->comment('Quantidade maxima no dia');
            $table->string('scale_comments')->nullable()->comment('Comentários');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_contracts_pvd_scales');
    }
}
