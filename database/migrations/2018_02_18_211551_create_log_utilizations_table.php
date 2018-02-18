<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogUtilizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('log_utilizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->nullable();
            $table->string('no_utilization')->nullable();
            $table->datetime('date_utilization');
            $table->string('to')->nullable();
            $table->string('from')->nullable();
            $table->datetime('expected_receive_date');
            $table->integer('booked_by')->nullable();
            $table->string('estimation_code')->nullable();
            $table->datetime('date_booked');
            $table->string('eb_kpi')->nullable();
            $table->string('account_code')->nullable();
            $table->decimal('real_amount', 8, 2);
            $table->decimal('proposed_amount', 8, 2);
            $table->text('details')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();       
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
        //
        Schema::drop('log_utilizations');
    }
}
