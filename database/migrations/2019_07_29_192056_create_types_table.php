<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('types')->insert([
            'name' => 'Pork',
            'slug' => 'pork',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Chicken',
            'slug' => 'chicken',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Noodles',
            'slug' => 'noodles',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Seafoods',
            'slug' => 'seafoods',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Beef',
            'slug' => 'beef',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Soup',
            'slug' => 'soup',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Desserts',
            'slug' => 'desserts',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Rice',
            'slug' => 'rice',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'Refreshments',
            'slug' => 'refreshments',
            'description' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
