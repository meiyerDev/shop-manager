<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacetoPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placeto_pays', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->foreignId('order_id')->constrained('orders');
            $table->string('request_id')->unique();
            $table->longText('data_payment');
            $table->longText('data_buyer');
            $table->dateTime('expiration');
            $table->string('return_url');
            $table->string('cancel_url');
            $table->string('ip_address');
            $table->string('user_agent');
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
        Schema::dropIfExists('placeto_pays');
    }
}
