<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMutations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_mutations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->nullable();
            $table->decimal('amount', 8, 2);
            $table->decimal('proposed_amount', 8, 2);
            $table->integer('warehouse_id')->nullable();
            $table->integer('proposed_warehouse_id')->nullable();
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
        Schema::drop('log_mutations');
    }
}
