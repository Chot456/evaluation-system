<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Questionaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionaire', function (Blueprint $table) {
            $table->id();
            $table->string('questionDescription');
            $table->unsignedBigInteger('userTypeId');
            $table->foreign('userTypeId')->references('id')->on('user_type');
            $table->unsignedBigInteger('questionCategoryId');
            $table->foreign('questionCategoryId')->references('id')->on('questionaire_category');
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
        Schema::dropIfExists('questionaire');
    }
}
