<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('customer_sys_id')->unsigned();
            $table->foreign('customer_sys_id')->references('id')->on('tb_customersys');
            //
            $table->bigInteger('user_id')->unsigned()->comment('Usuário que fez o cadastro');
            $table->foreign('user_id')->references('id')->on('users');
            //
            $table->bigInteger('status_id')->unsigned()->default(1);
            $table->foreign('status_id')->references('id')->on('ref_customer_status');
            //
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_customer_type');
            //
            $table->string('cus_doc_type')->comment('CPF ou CNPJ');
            $table->string('cus_doc_num')->comment('NUMERO');
            $table->string('cus_name')->comment('PF:Nome ou PJ:Nome Fantasia');
            $table->string('cus_name_company')->nullable()->comment('Razao Social');
            $table->string('cus_slug');
            //
            $table->string('cus_phone');
            $table->string('cus_email');
            //
            $table->string('cus_street')->nullable()->comment('Endereço');
            $table->string('cus_street_num')->nullable()->comment('Número');
            $table->string('cus_street_complement')->nullable()->comment('Complemento');
            $table->string('cus_neighborhood')->nullable()->comment('Bairro');
            $table->string('cus_city')->nullable()->comment('Cidade');
            $table->string('cus_state')->nullable()->comment('Estado');
            $table->string('cus_postalcode')->nullable()->comment('CEP');
            //
            $table->string('cus_manager_name')->nullable();
            $table->string('cus_manager_phone')->nullable();
            $table->string('cus_manager_email')->nullable();
            //
            $table->string('cus_financial_name')->nullable();
            $table->string('cus_financial_phone')->nullable();
            $table->string('cus_financial_email')->nullable();
            //
            $table->string('cus_logo_use')->nullable()->default('none');
            $table->string('cus_logo')->nullable();
            //
            $table->bigInteger('bank_id')->unsigned()->comment('Banco')->nullable();
            $table->foreign('bank_id')->references('id')->on('list_bank');
            $table->integer('bank_agency_num')->nullable();
            $table->integer('bank_agency_dv')->nullable();
            $table->bigInteger('bank_account_type_id')->unsigned()->comment('Tipo da Conta')->nullable();
            $table->foreign('bank_account_type_id')->references('id')->on('list_bank_account_type');
            $table->integer('bank_account_num')->nullable();
            $table->integer('bank_account_dv')->nullable();
            $table->integer('bank_account_operation')->nullable();

            $table->unique(['customer_sys_id','cus_doc_num'], 'uq_customer_customersys_cus_doc_num');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_customers');
    }
}
