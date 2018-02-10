<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->string('name')->nullable();
            $table->string('cardnumber')->nullable();
            $table->string('komag')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('unit')->nullable();
            $table->string('year_acquisition')->nullable();
            $table->decimal('amount', 8, 2);
            $table->decimal('unit_price', 14, 2);
            $table->decimal('total_proposed_amount', 8, 2);
            $table->text('details')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('type')->nullable();
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
        Schema::drop('log_materials');
    }
}
