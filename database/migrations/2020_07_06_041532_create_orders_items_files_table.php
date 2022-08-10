<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_orders_items_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('order_item_id')->unsigned();
            $table->foreign('order_item_id')->references('id')->on('tb_orders_items');
            //
            $table->string('file_type')->nullable();
            $table->string('file_mime_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('file_name');
            //
            $table->string('file');
            $table->string('file_description')->nullable()->comment('Descrição');
            $table->string('file_comments')->nullable()->comment('Comentários');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_orders_items_files');
    }
}
