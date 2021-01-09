<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject', function (Blueprint $table) {
            $table->id();
            $table->string('subjCode');
            $table->string('subjDesc');
            $table->string('schedTime');
            $table->string('schedDay');
            $table->string('semester');
            $table->unsignedBigInteger('profId');
            $table->foreign('profId')->references('id')->on('prof');
            $table->string('unit');
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('student');
            $table->string('rmCod');
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
        //
    }
}
