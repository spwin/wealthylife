<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('question_id')->nullable()->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('set null');
            $table->integer('price_scheme_id')->nullable()->unsigned();
            $table->foreign('price_scheme_id')->references('id')->on('price_schemes')->onDelete('set null');
            $table->integer('voucher_id')->nullable()->unsigned();
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('set null');
            $table->integer('status');
            $table->string('braintree_id');
            $table->enum('type', ['question', 'credits', 'vouchers']);
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
        Schema::drop('orders');
    }
}
