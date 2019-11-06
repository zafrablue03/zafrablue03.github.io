<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');
            $table->float('transportation_charge', 8,2);
            $table->float('payment', 8,2);
            $table->boolean('is_paid')->default(false);
            $table->float('payable',8,2);
            $table->float('balance', 8,2);
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->float('charge_fee', 8,2)->nullable();
            $table->timestamps();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payables');
    }
}
