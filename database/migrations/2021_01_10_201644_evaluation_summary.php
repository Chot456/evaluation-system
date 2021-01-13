<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluationSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_summary', function (Blueprint $table) {
            $table->id();
            $table->integer('evaluatorId');
            $table->unsignedBigInteger('userTypeId');
            $table->foreign('userTypeId')->references('id')->on('user_type');
            $table->unsignedBigInteger('courseId');
            $table->foreign('courseId')->references('id')->on('course');
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
        Schema::dropIfExists('evaluation_summary');
    }
}
