<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMaterialInvestasis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_material_investasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->nullable();
            $table->string('status')->nullable();
            $table->string('surplus_material')->nullable();

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
        Schema::drop('log_material_investasis');
    }
}
