<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('image_id')->nullable()->unsigned();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->enum('gender', ['male', 'female']);
            $table->float('weight');
            $table->float('height');
            $table->text('about');
            $table->date('birth_date');
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
        Schema::drop('user_data');
    }
}
