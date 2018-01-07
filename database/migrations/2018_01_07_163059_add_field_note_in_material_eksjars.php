<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldNoteInMaterialEksjars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_eksjars', function (Blueprint $table) {
            $table->text('note')->after('previous_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_eksjars', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
}
