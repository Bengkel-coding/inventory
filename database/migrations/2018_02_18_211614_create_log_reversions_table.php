<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogReversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('log_reversions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('utilization_id')->nullable();
            $table->string('no_return')->nullable();
            $table->datetime('date_return');
            $table->string('received_by')->nullable();
            $table->string('no_request')->nullable();
            $table->datetime('date_request');
            $table->decimal('amount_return', 8, 2);
            $table->integer('user_id')->nullable();     
            $table->integer('status')->nullable();

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
        //
        Schema::drop('log_reversions');
    }
}
