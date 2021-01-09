<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Evaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studId');
            $table->foreign('studId')->references('id')->on('student');
            $table->unsignedBigInteger('profId');
            $table->foreign('profId')->references('id')->on('prof');
            $table->unsignedBigInteger('subjectId');
            $table->foreign('subjectId')->references('id')->on('prof');
            $table->string('evalPassion');
            $table->string('evalInteraction');
            $table->string('evalOrganization');
            $table->string('evalSpeech');
            $table->string('evalPacing');
            $table->string('evalDisclosure');
            $table->string('evalRapport');
            $table->string('evalClassMgt');
            $table->string('evalPersonality');
            $table->string('comment');
            $table->string('evalDate');
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
        Schema::dropIfExists('users');
    }
}
