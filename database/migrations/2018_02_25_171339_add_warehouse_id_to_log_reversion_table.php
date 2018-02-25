<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWarehouseIdToLogReversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_reversions', function (Blueprint $table) {
            $table->integer('warehouse_id')->after('id')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_reversions', function (Blueprint $table) {
            $table->dropColumn('warehouse_id');
            //
        });
    }
}
