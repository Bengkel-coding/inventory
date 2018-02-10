<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSerialnumberInTableLogMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_materials', function (Blueprint $table) {
            $table->string('serialnumber')->after('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_materials', function (Blueprint $table) {
            $table->dropColumn('serialnumber');
        });
    }
}
