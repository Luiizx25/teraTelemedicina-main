<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Foreach_;

class CreateRolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_users_customersys_permissions_roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('tb_users_customersys_roles');
            //
            $table->bigInteger('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('tb_users_customersys_permissions');

            //Create a Unique Constraint
            $table->unique(['role_id','permission_id'], 'uq_rel_customersys_role_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_users_customersys_permissions_roles');
    }
}
