<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->longText('full_url')->nullable();
            $table->longText('method')->nullable();
            $table->longText('client_ip')->nullable();
            $table->longText('status_code')->nullable();
            $table->longText('response')->nullable();
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
        Schema::dropIfExists('logs_activities');
    }
}
