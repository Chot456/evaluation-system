<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('studId')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->unsignedBigInteger('courseId');
            $table->foreign('courseId')->references('id')->on('course');
            $table->unsignedBigInteger('yearId');
            $table->foreign('yearId')->references('id')->on('year');
            $table->unsignedBigInteger('semesterId');
            $table->foreign('semesterId')->references('id')->on('semester');
            $table->string('password');
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
        Schema::dropIfExists('student');
    }
}
