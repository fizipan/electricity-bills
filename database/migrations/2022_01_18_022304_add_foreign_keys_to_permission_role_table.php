<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_role', function (Blueprint $table) {
            $table->foreign('role_id', 'fk_permission_role_to_roles')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('permission_id', 'fk_permission_role_to_permissions')->references('id')->on('permissions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('fk_permission_role_to_roles');
            $table->dropForeign('fk_permission_role_to_permissions');
        });
    }
}
