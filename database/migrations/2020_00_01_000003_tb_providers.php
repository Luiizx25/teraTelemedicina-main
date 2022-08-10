<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_providers', function (Blueprint $table) {
            //
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('customer_sys_id')->unsigned();
            $table->foreign('customer_sys_id')->references('id')->on('tb_customersys');
            //
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //
            $table->boolean('active')->default(1);
            //
            $table->string('pvd_genre')->comment('Masculino / Feminino');
            //
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_provider_type');
            //
            $table->bigInteger('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('ref_provider_specialty');
            //
            $table->string('pvd_doc_type')->comment('CPF ou CNPJ');
            $table->string('pvd_doc_num')->comment('NUMERO');
            //
            $table->string('pvd_identity_type')->comment('CPF ou CNPJ ou CRM ou ...');
            $table->string('pvd_identity_num')->comment('NUMERO');
            $table->string('pvd_identity_uf')->comment('UF');
            //
            $table->string('pvd_slug');
            //
            $table->string('pvd_name_company')->nullable()->comment('Razao Social');

            $table->string('pvd_street')->nullable();
            $table->string('pvd_street_num')->nullable();
            $table->string('pvd_street_complement')->nullable();
            $table->string('pvd_neighborhood')->nullable()->comment('Bairro');
            $table->string('pvd_city')->nullable()->comment('Cidade');
            $table->string('pvd_state')->nullable()->comment('Estado');
            $table->string('pvd_postalcode')->nullable()->comment('CEP');
            //
            $table->boolean('pvd_logo_use')->default(false)->nullable();
            $table->string('pvd_logo')->nullable();
            //
            $table->boolean('pvd_signature_use')->default(false);
            $table->string('pvd_signature')->nullable();
            //
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

            $table->unique(['customer_sys_id','pvd_slug'], 'uq_provider_customersys_slug');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_providers');
    }
}
