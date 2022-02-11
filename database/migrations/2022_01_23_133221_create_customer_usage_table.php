<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->index('fk_customer_usage_to_customer');
            $table->date('date_usage');
            $table->string('start_meter');
            $table->string('end_meter');
            $table->date('date_check');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_usage');
    }
}
