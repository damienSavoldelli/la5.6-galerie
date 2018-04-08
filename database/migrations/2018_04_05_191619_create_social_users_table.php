<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_users', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('provider_user_id');
            $table->string('provider');
            $table->string('avatar', 120);
            $table->string('verified');
            $table->timestamps();

            $table->unique(['user_id', 'provider_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_users', function(Blueprint $table) {
            $table->dropForeign('social_users_user_id_foreign');
        });

        Schema::dropIfExists('social_users');
    }
}
