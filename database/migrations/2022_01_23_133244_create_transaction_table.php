<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_usage_id')->nullable()->index('fk_transaction_to_customer_usage');
            $table->string('code');
            $table->dateTime('date_pay')->nullable();
            $table->string('total_meter');
            $table->string('total_price');
            $table->text('photo')->nullable();
            $table->enum('status', [1, 2, 3])->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
