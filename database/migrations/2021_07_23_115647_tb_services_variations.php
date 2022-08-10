<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbServicesVariations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATE VARIATIONS
        Schema::create('tb_services_variations', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('tb_services');
            //
            $table->string('variation_name');
        });

        // ALTER ORDER_ITEM
        Schema::table('tb_orders_items', function (Blueprint $table) {
            //
            $table->bigInteger('service_variation_id')->unsigned()->nullable();
            $table->foreign('service_variation_id')->references('id')->on('tb_services_variations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
