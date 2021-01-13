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
            $table->string('yearDescription');
            $table->foreign('yearDescription')->references('yearDescription')->on('year')->onDelete('cascade');
            $table->string('courseDescription');
            $table->foreign('courseDescription')->references('courseDescription')->on('course')->onDelete('cascade');
            $table->string('semesterDescription');
            $table->foreign('semesterDescription')->references('semesterDescription')->on('semester')->onDelete('cascade');
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
