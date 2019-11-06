<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureInclusionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_inclusion', function (Blueprint $table) {
            $table->primary(['feature_id', 'inclusion_id']);
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('inclusion_id');

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->foreign('inclusion_id')->references('id')->on('inclusions')->onDelete('cascade');
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
        Schema::dropIfExists('feature_inclusion');
    }
}
