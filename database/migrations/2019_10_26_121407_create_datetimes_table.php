<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datetimes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('time');
            $table->timestamps();
        });

        DB::table('datetimes')->insert([
            'name'  =>  'lunch',
            'time'  =>  '12:00',
        ]);
        DB::table('datetimes')->insert([
            'name'  =>  'breakfast',
            'time'  =>  '06:00',
        ]);
        DB::table('datetimes')->insert([
            'name'  =>  'dinner',
            'time'  =>  '18:00',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datetimes');
    }
}
