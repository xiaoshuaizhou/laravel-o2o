<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biss', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name',50);
            $table->string('email')->unique();
            $table->string('logo');
            $table->string('licence_logo');
            $table->text('description');
            $table->string('city_path',50);
            $table->string('bank_info',50);
            $table->decimal('money',20,2);
            $table->string('bank_name',50);
            $table->string('bank_user',50);
            $table->string('faren',20);
            $table->string('faren_tel',20);
            $table->integer('listorder');
            $table->integer('status');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')
                    ->references('id')
                    ->on('citys')
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
        Schema::dropIfExists('biss');
    }
}
