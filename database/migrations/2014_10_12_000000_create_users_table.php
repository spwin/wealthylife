<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['user', 'consultant', 'admin']);
            $table->string('email')->unique();
            $table->string('password');
            $table->text('timetable');
            $table->boolean('referral_rewarded')->default(0);
            $table->string('referral_key');
            $table->integer('referral_id')->nullable()->unsigned();
            $table->foreign('referral_id')->references('id')->on('users');
            $table->integer('referrals_registered')->default(0);
            $table->integer('referrals_confirmed')->default(0);
            $table->integer('referrals_points')->default(0);
            $table->integer('points');
            $table->integer('status');
            $table->boolean('email_confirmed');
            $table->boolean('welcome')->default(0);
            $table->boolean('super');
            $table->boolean('local')->default(1);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
