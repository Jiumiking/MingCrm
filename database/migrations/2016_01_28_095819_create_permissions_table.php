<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('权限名称 填入route name');
            $table->string('group')->comment('权限组名，权限可以分组，显示配置页面按group区分');
            $table->integer('type')->default('1')->comment('权限类型, 1为url类型，2为普通权限（不绑定url）');
            $table->timestamps();
        });
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->integer('role_id')->index();
            $table->integer('permission_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions');
        Schema::drop('roles_permissions');
    }
}
