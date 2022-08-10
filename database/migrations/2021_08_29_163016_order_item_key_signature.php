<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderItemKeySignature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_orders_items', function (Blueprint $table)
        {
            $table->string('chave')->comment('Chave de identificação da assinatura')->nullable();
        });
    }
}
