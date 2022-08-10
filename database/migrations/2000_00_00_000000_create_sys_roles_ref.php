<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysRolesRef extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_users_customersys_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->string('role_name')->unique();
            $table->string('role_label');
            $table->string('role_comments')->comment('Comentários')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_users_customersys_roles');
    }
}
