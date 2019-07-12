<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            //Basic
            $table->string('basic-name')->default('lethal.board');
            $table->mediumText('basic-meta')->nullable();
            $table->string('basic-image')->default('default');
            $table->string('basic-url');

            $table->tinyInteger('basic-widget_online');
            $table->tinyInteger('basic-widget_statistics');

            //Mail
            $table->string('email-address');
            $table->string('email-sender');

            //Registration
            $table->tinyInteger('registration-enable');
            $table->tinyInteger('registration-mail_confirmation');
            $table->tinyInteger('registration-welcome_mail');
            $table->tinyInteger('registration-register_captcha');

            //Search
            $table->tinyInteger('search-enable');

            //Topics, Forums & Conversations
            $table->string('tfc-paginate');
            $table->integer('tfc-max_length_mesaage')->default(10000);
            $table->integer('tfc-max_length_title')->default(255);
            $table->integer('tfc-max_poll_choice')->default(6);

            //Profiles
            $table->integer('profile-max_avatar_resolution')->default(400);
            $table->integer('profile-max_length_bio')->default(1200);
            $table->integer('profile-max_length_signature')->default(400);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
