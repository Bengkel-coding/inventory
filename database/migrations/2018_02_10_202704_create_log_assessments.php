<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAssessments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->nullable();
            $table->decimal('amount', 8, 2);
            $table->decimal('proposed_amount', 8, 2);
            $table->integer('user_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('warehouse_id')->nullable();

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
        Schema::drop('log_assessments');
    }
}
