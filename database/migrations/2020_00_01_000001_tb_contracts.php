<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_contracts_customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('tb_customers');
            //
            $table->bigInteger('contract_previous_id')->unsigned()->nullable()->comment('Contrato Anterior referencia se houver');
            $table->foreign('contract_previous_id')->references('id')->on('tb_contracts_customers');
            //
            $table->boolean('active')->default(1);
            //
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_contract_cus_type');
            //
            $table->string('contract_num')->nullable();
            $table->date('contract_date');
            $table->date('contract_date_start')->nullable();
            $table->date('contract_date_end')->nullable();
            //
            $table->boolean('contract_volume_free')->default(true)->comment('Volume Livre');
            $table->string('contract_comments')->nullable();
            //
            $table->integer('invoice_day');
            $table->bigInteger('invoice_pay_option_id')->unsigned();
            $table->foreign('invoice_pay_option_id')->references('id')->on('ref_invoice_pay_option');
        });

        Schema::create('tb_contracts_customers_additives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //
            $table->bigInteger('contract_id')->unsigned();
            $table->foreign('contract_id')->references('id')->on('tb_contracts_customers');
            //
            $table->dateTime('additive_date');
            $table->dateTime('additive_date_conciliation');
            //
            $table->longText('contract_old');
            $table->longText('contract_new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_contract_customers');
    }
}
