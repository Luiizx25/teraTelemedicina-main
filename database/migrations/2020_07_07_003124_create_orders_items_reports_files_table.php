<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsReportsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_orders_items_reports_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('report_id')->unsigned();
            $table->foreign('report_id')->references('id')->on('tb_orders_items_reports');
            //
            $table->string('file_type')->nullable();
            //
            $table->string('file');
            $table->string('file_description')->nullable()->comment('Descrição');
            $table->string('file_comments')->nullable()->comment('Comentários');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_orders_items_reports_files');
    }
}
