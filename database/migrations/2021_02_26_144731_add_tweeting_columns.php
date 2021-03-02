<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTweetingColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('post_counter')->nullable()->default(0);;
            $table->string('access_token')->nullable();
            $table->string('access_token_secret')->nullable();
            $table->timestamp('last_tweet')->nullable()->default('2000-01-01 00:00:01');
            
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('users', ['access_token', 'access_token_secret', 'post_counter','last_tweet']);
    }
}
