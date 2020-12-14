<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNameToNicknameOnProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
            $table->renameColumn('name','nickname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     // ロールバックしたときに呼び出すメソッド
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
            $table->renameColumn('nickname','name');
        });
    }
}
