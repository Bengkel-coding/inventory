<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('utilization_id')->unsigned();
            $table->string('no_return')->nullable();
            $table->datetime('date_return');
            $table->string('received_by')->default(0);
            $table->string('no_request')->nullable();
            $table->datetime('date_request');
            $table->decimal('amount_return', 8, 2);
            $table->integer('user_id')->unsigned();     
            $table->integer('status')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('utilization_id')->references('id')->on('utilizations')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('returns');
    }
}
