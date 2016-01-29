<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('mobile',20)->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->dateTime('last_login_at')->comment('最后一次登入时间');
            $table->string('last_login_ip',32)->comment('最后一次登入ip');
            $table->integer('role_id');
            $table->integer('status');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
