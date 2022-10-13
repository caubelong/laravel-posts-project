<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('p_id');
            $table->string('title');
            $table->longText('body');
            $table->unsignedBigInteger('category_id');
            $table->string('cover_img')->default('imgEmpty.jpg');
            $table->integer('view')->default(0);
            $table->longText('description');
            $table->timestamps();
        });
        Schema::table('posts', function ($table){
            $table->foreign('category_id')->references('chil_cate_id')->on('category_childrens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
