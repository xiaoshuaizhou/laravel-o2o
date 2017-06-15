<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdminColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('is_admin', 8)->default('F');
            $table->smallInteger('is_active')->default(0);   //是否激活邮箱
            $table->string('confirmation_toker')->default(0);   //激活邮箱的随机字符串
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('is_active');
            $table->dropColumn('confirmation_toker');
        });
    }
}
