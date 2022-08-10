<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            //
            $table->integer('active')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->rememberToken();
            $table->string('user_role')->default('APP_USER');
            $table->boolean('admin_syscustomer')->default(false);
            $table->boolean('admin_system')->default(false);
            $table->boolean('admin_customer')->default(false);
            $table->boolean('admin_provider')->default(false);
            $table->boolean('admin_patient')->default(false);
            $table->boolean('admin_financial')->default(false);
            $table->boolean('admin_billing')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
