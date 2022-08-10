<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_orders_items_reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('tb_orders_items');
            //
            $table->bigInteger('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('tb_providers');
            //
            $table->bigInteger('report_type_id')->unsigned();
            $table->foreign('report_type_id')->references('id')->on('ref_report_type');
            //
            $table->bigInteger('report_status_id')->unsigned();
            $table->foreign('report_status_id')->references('id')->on('ref_report_status');
            //
            $table->string('report_cycle')->nullable();
            //
            $table->string('report_comments')->comment('Comentários')->nullable();
            $table->longText('report_results')->comment('Resultados do serviço')->nullable();
            $table->string('report_results_comments')->comment('Comentáriosdo resultado')->nullable();
            $table->longText('report_conclusion')->comment('Conclusão do serviço');
            $table->string('report_conclusion_file_name')->nullable();
            $table->string('report_conclusion_file_path')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_orders_items_reports');
    }
}
