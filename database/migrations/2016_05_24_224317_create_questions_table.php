<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('consultant_id')->nullable()->unsigned();
            $table->foreign('consultant_id')->references('id')->on('users')->onDelete('set null');
            $table->text('question');
            $table->string('status');
            $table->string('ip');
            $table->dateTime('asked_at');
            $table->dateTime('answered_at');
            $table->timestamps();
        });

        Schema::create('image_question', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sort')->unsigned();
            $table->integer('image_id')->nullable()->unsigned();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('question_id')->nullable()->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
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
        Schema::drop('image_question');
        Schema::drop('questions');
    }
}
