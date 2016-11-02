<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->nullable()->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('consultant_id')->nullable()->unsigned();
            $table->foreign('consultant_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('payroll_id')->nullable()->unsigned();
            $table->foreign('payroll_id')->references('id')->on('payroll')->onDelete('set null');
            $table->text('answer');
            $table->boolean('seen');
            $table->boolean('rated')->default(0);
            $table->integer('rating')->default(0);
            $table->text('feedback');
            $table->string('ip');
            $table->integer('time');
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
        Schema::drop('answers');
    }
}
