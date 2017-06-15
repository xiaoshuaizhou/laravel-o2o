<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('bis_id')->unsigned();
            $table->string('username',50);
            $table->string('password',60);
            $table->string('last_login_ip',30);
            $table->timestamp('last_login_time');
            $table->integer('is_man');
            $table->integer('listorder');
            $table->integer('status');
            $table->foreign('bis_id')
                    ->references('id')
                    ->on('biss')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('accounts');
    }
}
