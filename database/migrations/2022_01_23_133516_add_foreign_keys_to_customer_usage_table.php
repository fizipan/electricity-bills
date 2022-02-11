<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCustomerUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_usage', function (Blueprint $table) {
            $table->foreign('customer_id', 'fk_customer_usage_to_customer')
                    ->references('id')
                    ->on('customer')
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
        Schema::table('customer_usage', function (Blueprint $table) {
            $table->dropForeign('fk_customer_usage_to_customer');
        });
    }
}
