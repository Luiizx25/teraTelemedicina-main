<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServicePreResponses extends Migration
{
    public function up()
    {
        Schema::create('tb_services_preresponses', function (Blueprint $table)
        {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('tb_services');
            //
            $table->string('slug');
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('body');
            //
            $table->unique(['service_id','slug'], 'tb_services_preresponses_uq_service_id_slug');
        });
    }
}
