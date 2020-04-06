<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description');
            $table->integer('price');
            $table->string('main_image');
            $table->string('gallery');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('city_id');
            $table->integer('active');
            $table->date('date_expired');
            $table->date('date_created');
            $table->integer('views');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('ads');
    }
}
