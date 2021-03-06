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
            $table->string('evaluatorId')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->integer('rating')->nullable();
            $table->string('remarks')->nullable();
            $table->date('evaluationDate')->nullable();
            $table->string('report')->nullable();
            $table->string('publish')->nullable();
            $table->string('a1')->nullable();
            $table->string('a2')->nullable();
            $table->string('a3')->nullable();
            $table->string('a4')->nullable();
            $table->string('a5')->nullable();
            $table->string('a6')->nullable();
            $table->string('a7')->nullable();
            $table->string('a8')->nullable();
            $table->string('a9')->nullable();
            $table->string('a10')->nullable();
            $table->string('a11')->nullable();
            $table->string('a12')->nullable();
            $table->string('a13')->nullable();
            $table->string('a14')->nullable();
            $table->string('a15')->nullable();
            $table->string('a16')->nullable();
            $table->string('a17')->nullable();
            $table->string('a18')->nullable();
            $table->string('a19')->nullable();
            $table->string('a20')->nullable();
            $table->string('userTypeDescription');
            $table->foreign('userTypeDescription')->references('userTypeDescription')->on('user_type')->onDelete('cascade');
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
        Schema::dropIfExists('evaluation');
    }
}
