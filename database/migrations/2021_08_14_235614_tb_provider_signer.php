<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbProviderSigner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_providers', function (Blueprint $table)
        {
            $table->string('certificate')->comment('Caminho do Certificado')->nullable();
        });
    }
}
