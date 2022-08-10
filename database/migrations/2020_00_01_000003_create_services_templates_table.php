<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_services_templates_fields', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->boolean('used_order')->default(false);
            $table->boolean('used_report')->default(false);
            $table->boolean('field_required')->default(false);
            $table->string('field_nickname');
            $table->string('field_label');
            $table->string('field_value_default')->nullable();
            //
            $table->bigInteger('field_type_id')->unsigned();
            $table->foreign('field_type_id')->references('id')->on('ref_template_field_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_services_templates_fields');
    }
}
