<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        DB::table('features')->insert([
            'name'          =>  '1 Round of Purified Drinking Water',
            'created_at'    =>  \Carbon\Carbon::now(),
            'updated_at'    =>  \Carbon\Carbon::now(),
        ]);
        DB::table('features')->insert([
            'name'          =>  'Uniformed Waiter',
            'created_at'    =>  \Carbon\Carbon::now(),
            'updated_at'    =>  \Carbon\Carbon::now(),
        ]);
        DB::table('features')->insert([
            'name'          =>  '1 Choice of Dessert',
            'created_at'    =>  \Carbon\Carbon::now(),
            'updated_at'    =>  \Carbon\Carbon::now(),
        ]);
        DB::table('features')->insert([
            'name'          =>  'Table Dressing',
            'created_at'    =>  \Carbon\Carbon::now(),
            'updated_at'    =>  \Carbon\Carbon::now(),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features');
    }
}
