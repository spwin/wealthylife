<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->integer('discount_id')->nullable()->unsigned();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('set null');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('question_id')->nullable()->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('set null');
            $table->float('points');
            $table->float('to_pay');
            $table->string('token');
            $table->boolean('used')->default(0);
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
        Schema::drop('order_drafts');
    }
}
