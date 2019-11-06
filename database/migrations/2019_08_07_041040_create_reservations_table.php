<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->text('message')->nullable();
            $table->date('date');
            $table->string('venue')->nullable();
            $table->integer('pax')->nullable();
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('set_id')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->unsignedInteger('inclusion_id')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
