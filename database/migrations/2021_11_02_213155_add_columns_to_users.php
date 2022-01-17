<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
class AddColumnsToUsers extends Migration
{
 
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile')->default('');
            $table->string('image')->default('');
        });
    }
 
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // upメソッドでのカラム追加を取り消す処理内容にする
            $table->dropColumn('profile');
            $table->dropColumn('image');
        });
    }
}