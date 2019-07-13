<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {

            $table->string('user_id')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->mediumText('signature')->nullable();
            $table->mediumText('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('discord')->nullable();
            $table->string('steam')->nullable();
            $table->string('minecraft')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->string('reddit')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('trophies')->default(0);

            $table->char('language', 5)->default('en');
            $table->tinyInteger('recieve_emails')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
