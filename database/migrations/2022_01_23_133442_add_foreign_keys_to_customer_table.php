<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->foreign('users_id', 'fk_customer_to_users')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');

            $table->foreign('rate_id', 'fk_customer_to_rate')
                    ->references('id')
                    ->on('rate')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropForeign('fk_customer_to_users');
            $table->dropForeign('fk_customer_to_rate');
        });
    }
}
