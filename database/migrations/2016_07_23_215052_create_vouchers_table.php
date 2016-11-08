<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('used_by')->nullable()->unsigned();
            $table->foreign('used_by')->references('id')->on('users')->onDelete('set null');
            $table->integer('price_scheme_id')->nullable()->unsigned();
            $table->foreign('price_scheme_id')->references('id')->on('price_schemes')->onDelete('set null');
            $table->float('price');
            $table->string('receiver_email');
            $table->string('code')->unique();
            $table->string('url_key');
            $table->integer('credits');
            $table->text('message');
            $table->integer('anonymous');
            $table->integer('status');
            $table->boolean('generated');
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
        Schema::drop('vouchers');
    }
}
