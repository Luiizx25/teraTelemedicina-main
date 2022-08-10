<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefsServiceCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_service_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_type_id')->unsigned();
            $table->foreign('service_type_id')->references('id')->on('ref_service_type');
            $table->string('ref_slug');
            $table->string('ref_description');
            $table->string('ref_placeholder')->nullable();
            $table->string('ref_options')->nullable();
            $table->boolean('ref_to_view')->default(true);
            $table->string('ref_icon')->nullable()->default('activity');
            $table->string('ref_color')->nullable()->default('thmeme-1');
            //
            $table->bigInteger('customer_sys_id')->nullable()->unsigned();
            $table->foreign('customer_sys_id')->references('id')->on('tb_customersys');
            //
            $table->timestamps();
            $table->softDeletes();
            //
            $table->unique(['customer_sys_id','ref_slug'], "uq_ref_service_category_customersys_slug");
        });
    }
    public function down()
    {
        Schema::dropIfExists('ref_service_category');
    }
}
