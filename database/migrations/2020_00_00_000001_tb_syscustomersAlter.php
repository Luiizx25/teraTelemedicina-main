<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbSyscustomersAlter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_customersys', function (Blueprint $table) {
            //
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('ref_customersys_status');

            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ref_customersys_type');

            $table->string('csys_slug')->nullable()->comment('Apelido do CLiente no Sistema');
            //
            $table->string('csys_doc_type')->comment('CPF ou CNPJ');
            $table->string('csys_doc_num')->comment('NUMERO');
            $table->string('csys_name')->comment('PF:Nome ou PJ:Nome Fantasia');
            $table->string('csys_name_company')->nullable()->comment('Razao Social');
            //
            $table->string('csys_street')->nullable();
            $table->string('csys_street_num')->nullable();
            $table->string('csys_street_complement')->nullable();
            $table->string('csys_street_neighborhood')->nullable()->comment('Bairro');
            $table->string('csys_city')->nullable()->comment('Cidade');
            $table->string('csys_state')->nullable()->comment('Estado');
            $table->string('csys_postalcode')->nullable()->comment('CEP');
            //
            $table->string('csys_phone');
            $table->string('csys_email');
            //
            $table->string('csys_comments')->nullable();
            //
            $table->unique('csys_slug','uq_customersys_slug');
            $table->unique(['csys_doc_type','csys_doc_num'],'uq_customersys_doc_type_doc_num');
        });
    }
}
