<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rate', function (Blueprint $table) {
            $table->foreign('group_rate_id', 'fk_rate_to_group_rate')
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
        Schema::table('rate', function (Blueprint $table) {
            $table->dropForeign('fk_rate_to_group_rate');
        });
    }
}
