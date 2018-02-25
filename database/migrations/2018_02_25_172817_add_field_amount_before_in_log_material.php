<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldAmountBeforeInLogMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_materials', function (Blueprint $table) {
            $table->integer('amount_current')->after('amount')->default(0);
            $table->string('action')->after('note')->nullable();
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
            $table->dropColumn(['amount_after','action']);
        });
    }
}
