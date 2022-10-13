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
        Schema::create('category_childrens', function (Blueprint $table) {
            $table->bigIncrements('chil_cate_id');
            $table->string('name');
            $table->unsignedBigInteger('parent_id');
            $table->timestamps();
        });
        Schema::table('category_childrens', function ($table){
            $table->foreign('parent_id')->references('cate_id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_childrens');
    }
};
