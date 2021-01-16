<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->string('section_code');
            $table->string('subjCode');
            $table->foreign('subjCode')->references('subjCode')->on('subject')->onDelete('cascade');
            $table->unsignedBigInteger('evaluator_id');
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->string('semesterDescription');
            $table->foreign('semesterDescription')->references('semesterDescription')->on('semester')->onDelete('cascade');
            $table->string('yearDescription');
            $table->foreign('yearDescription')->references('yearDescription')->on('year')->onDelete('cascade');
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
        Schema::dropIfExists('section');
    }
}
