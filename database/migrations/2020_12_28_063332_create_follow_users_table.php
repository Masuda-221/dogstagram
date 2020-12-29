<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('follow_id');
            $table->timestamps();
            
            // //外部キー制約
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');

            // 組み合わせのダブりを禁止
            $table->unique(['user_id', 'follow_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_users');
    }
}
