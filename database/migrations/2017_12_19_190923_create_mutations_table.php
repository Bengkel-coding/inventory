<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->unsigned();
            $table->decimal('amount', 8, 2);
            $table->decimal('proposed_amount', 8, 2);
            $table->integer('warehouse_id')->unsigned();
            $table->integer('proposed_warehouse_id')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('status')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('material_id')->references('id')->on('materials')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('warehouse_id')->references('id')->on('warehouses')
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
        Schema::drop('mutations');
    }
}
