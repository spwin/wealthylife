<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('image_id')->nullable()->unsigned();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
            $table->string('title');
            $table->string('url');
            $table->text('content');
            $table->dateTime('published_at')->nullable();
            $table->integer('status')->unigned()->default(0);
            $table->integer('visits')->unsigned()->default(0);
            $table->boolean('hide_email')->default(0);
            $table->boolean('hide_name')->default(0);
            $table->boolean('disable_comments')->default(0);
            $table->boolean('reviewed')->default(0);
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
        Schema::drop('article');
    }
}
