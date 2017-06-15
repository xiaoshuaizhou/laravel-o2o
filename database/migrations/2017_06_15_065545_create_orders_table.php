<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('out_trade_no');
            $table->string('transaction_id');
            $table->timestamp('pay_time');
            $table->integer('payment_id');
            $table->integer('pay_status');
            $table->decimal('total_price',20,2);
            $table->decimal('pay_amount',20,2);
            $table->integer('status');
            $table->string('referer');
            $table->string('username');
            $table->integer('user_id')->unsigned();
            $table->integer('deal_id')->unsigned();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('deal_id')
                    ->references('id')
                    ->on('deals')
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
        Schema::dropIfExists('orders');
    }
}
