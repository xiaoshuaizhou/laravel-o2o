<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('logo');
            $table->string('address');
            $table->string('tel',20);
            $table->string('contact',20);
            $table->string('xpoint',20);
            $table->string('ypoint',20);
            $table->timestamp('open_time');
            $table->text('content');
            $table->integer('is_main');
            $table->string('api_address');
            $table->string('city_path',50);
            $table->string('category_path');
            $table->string('bank_info',50);
            $table->integer('listorder');
            $table->integer('bis_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('status');
            $table->foreign('bis_id')
                    ->references('id')
                    ->on('biss')
                    ->onDelete('cascade');
            $table->foreign('city_id')
                    ->references('id')
                    ->on('citys')
                    ->onDelete('cascade');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categorys')
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
        Schema::dropIfExists('locations');
    }
}
