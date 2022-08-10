<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_patients', function (Blueprint $table) {
            //
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('customer_id')->unsigned()->comment('Cliente o qual o paciente pertence');
            $table->foreign('customer_id')->references('id')->on('tb_customers');
            //
            $table->bigInteger('user_id')->unsigned()->comment('Usuário ue cadastrou o paciente');
            $table->foreign('user_id')->references('id')->on('users');
            //
            $table->string('pat_doc_type')->comment('CPF ou CNPJ ou CRM ou ...')->nullable();
            $table->string('pat_doc_num')->comment('NUMERO');
            //
            $table->string('pat_identity_num')->comment('Número da identidade')->nullable();
            $table->string('pat_identity_emitting')->comment('Órgão Emissor')->nullable();
            //
            $table->string('pat_name');
            $table->date('pat_date_birth')->nullable();
            //
            $table->string('pat_genre');
            //
            $table->string('pat_phone_mobile')->nullable();
            $table->string('pat_phone')->nullable();
            $table->string('pat_email')->nullable();
            //
            $table->string('pat_street')->nullable();
            $table->string('pat_street_num')->nullable();
            $table->string('pat_street_complement')->nullable();
            $table->string('pat_street_neighborhood')->nullable()->comment('Bairro');
            $table->string('pat_city')->nullable()->comment('Cidade');
            $table->string('pat_state')->nullable()->comment('Estado');
            $table->string('pat_postalcode')->nullable()->comment('CEP');
            //
            $table->string('pat_work_company')->comment('Empresa que Trabalha')->nullable();
            $table->string('pat_work_position')->comment('Função na Empresa que Trabalha')->nullable();
            //
            $table->decimal('pat_weight')->comment('Peso do Paciente em centimetros')->nullable();
            $table->decimal('pat_height', 5,2)->comment('Altura do Paciente em gramas')->nullable();
            //
            $table->string('pat_comments')->comment('Comentários para o Paciente')->nullable();
            //
            $table->unique(['customer_id','pat_doc_num'], 'uq_patient_customer_pat_doc_num');
        });
    }
    public function down()
    {
        Schema::dropIfExists('tb_patients');
    }
}
