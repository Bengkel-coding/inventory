<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReversionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reversion_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reversion_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->decimal('real_amount', 8, 2);
            $table->decimal('proposed_amount', 8, 2);
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
        Schema::drop('reversion_details');
    }
}
