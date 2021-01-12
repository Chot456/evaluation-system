<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prof extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prof', function (Blueprint $table) {
            $table->id();
            $table->string('profId')->unique();
            $table->string('profName');
            $table->string('deptDescription');
            $table->foreign('deptDescription')->references('deptDescription')->on('department');
            $table->string('profDescription');
            $table->foreign('profDescription')->references('profDescription')->on('prof_type');
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
        Schema::dropIfExists('prof');
    }
}
