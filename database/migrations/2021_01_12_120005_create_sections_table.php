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
            $table->string('subject_code');
            $table->string('studId');
            $table->foreign('studId')->references('studId')->on('student')->onDelete('cascade');
            $table->string('profId');
            $table->foreign('profId')->references('profId')->on('prof')->onDelete('cascade');
            $table->string('semester');
            $table->string('year');
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
