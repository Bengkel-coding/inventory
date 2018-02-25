<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWarehouseIdToReversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reversions', function (Blueprint $table) {
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
        Schema::table('reversions', function (Blueprint $table) {
            $table->dropColumn('warehouse_id');
            //
        });
    }
}
