<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->integer('se_category_id');
            $table->string('location_ids',100);
            $table->string('image');
            $table->text('description');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->decimal('origin_price',20,2);
            $table->decimal('current_price',20,2);
            $table->integer('buy_count');
            $table->integer('total_count');
            $table->dateTime('coupons_begin_time');
            $table->dateTime('coupons_end_time');
            $table->string('xpoint',20);
            $table->string('ypoint',20);
            $table->decimal('balance_price',20,2);
            $table->text('notes');
            $table->integer('listorder');
            $table->integer('status');
            $table->integer('category_id')->unsigned();
            $table->integer('bis_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categorys')
                    ->onDelete('cascade');
            $table->foreign('bis_id')
                    ->references('id')
                    ->on('biss')
                    ->onDelete('cascade');
            $table->foreign('city_id')
                    ->references('id')
                    ->on('citys')
                    ->onDelete('cascade');
            $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts')
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
        Schema::dropIfExists('deals');
    }
}
