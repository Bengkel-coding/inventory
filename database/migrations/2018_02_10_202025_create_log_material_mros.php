<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMaterialMros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_material_mros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->nullable();
            $table->string('min_stock_level')->nullable();
            $table->string('max_stock_level')->nullable();
            $table->string('excess_stock')->nullable();
            $table->string('status')->nullable();

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
        Schema::drop('log_material_mros');
    }
}
