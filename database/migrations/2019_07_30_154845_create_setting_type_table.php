<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_type', function (Blueprint $table) {
            $table->primary(['setting_id', 'type_id']);
            $table->unsignedBigInteger('setting_id');
            $table->unsignedBigInteger('type_id');
            
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

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
        Schema::dropIfExists('setting_type');
    }
}
