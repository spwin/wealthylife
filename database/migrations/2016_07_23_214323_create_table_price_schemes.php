<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePriceSchemes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_schemes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->integer('credits');
            $table->float('price');
            $table->integer('questions');
            $table->string('type');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('price_schemes');
    }
}
