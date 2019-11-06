<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->string('image')->default('galery/default.jpg');
            $table->string('thumbnail')->default('thumbnail/default.jpg');
            $table->timestamps();
        });

        DB::table('services')->insert([
            'name'          =>  'Corporate',
            'slug'          =>  'corporate',
            'description'   =>  Str::random(30)
        ]);

        DB::table('services')->insert([
            'name'          =>  'Debuts',
            'slug'          =>  'debuts',
            'description'   =>  Str::random(30)
        ]);

        DB::table('services')->insert([
            'name'          =>  'Christmas Party',
            'slug'          =>  'christmas-party',
            'description'   =>  Str::random(30)
        ]);

        DB::table('services')->insert([
            'name'          =>  'Wedding',
            'slug'          =>  'wedding',
            'description'   =>  Str::random(30)
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
