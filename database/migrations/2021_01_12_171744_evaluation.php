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
            $table->string('evaluatorId');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->unsignedBigInteger('questionaireId');
            $table->foreign('questionaireId')->references('id')->on('questionaire');
            $table->integer('rating');
            $table->string('remarks');
            $table->date('evaluationDate');
            $table->string('report');
            $table->string('publish');
            $table->string('a1');
            $table->string('a2');
            $table->string('a3');
            $table->string('a4');
            $table->string('a5');
            $table->string('a6');
            $table->string('a7');
            $table->string('a8');
            $table->string('a9');
            $table->string('a10');
            $table->string('a11');
            $table->string('a12');
            $table->string('a13');
            $table->string('a14');
            $table->string('a15');
            $table->string('a16');
            $table->string('a17');
            $table->string('a18');
            $table->string('a19');
            $table->string('a20');
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
