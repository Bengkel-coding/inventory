<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMaterialEksjars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_material_eksjars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->nullable();
            $table->string('merk')->nullable();
            $table->string('specification')->nullable();
            $table->string('year_production')->nullable();
            $table->string('previous_location')->nullable();
            $table->text('note')->nullable();

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
        Schema::drop('log_material_eksjars');
    }
}
