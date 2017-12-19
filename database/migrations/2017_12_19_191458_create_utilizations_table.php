<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->unsigned();
            $table->string('no_utilization')->nullable();
            $table->datetime('date_utilization');
            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->datetime('expected_receive_date');
            $table->integer('booked_by')->default(0);
            $table->string('estimation_code')->nullable();
            $table->datetime('date_booked');
            $table->string('eb_kpi')->nullable();
            $table->string('account_code')->nullable();
            $table->decimal('real_amount', 8, 2);
            $table->decimal('proposed_amount', 8, 2);
            $table->text('details')->nullable();
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['mro', 'mroabt', 'investasi', 'eksjar', 'tercatat'])->default('mro');       
            $table->integer('status')->default(0);
            $table->integer('warehouse_id')->unsigned();

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
        Schema::drop('utilizations');
    }
}
