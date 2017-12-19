<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('category', ['tubular', 'cock', 'fitting', 'instrument', 'bahankimia', 'lainlain'])->default('tubular');
            $table->string('name')->nullable();
            $table->string('cardnumber')->nullable();
            $table->string('komag')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->enum('unit', ['meter', 'pieces', 'unit', 'liter', 'roll', 'buah'])->default('meter');
            $table->string('year_acquisition')->nullable();
            $table->decimal('amount', 8, 2);
            $table->decimal('unit_price', 10, 2);
            $table->text('details')->nullable();
            $table->integer('warehouse_id')->unsigned();
            $table->integer('status')->default(0);
            $table->enum('type', ['mro', 'mroabt', 'investasi', 'eksjar', 'tercatat'])->default('mro');


            $table->timestamps();
            $table->softDeletes();

            $table->foreign('warehouse_id')->references('id')->on('warehouses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materials');
    }
}
