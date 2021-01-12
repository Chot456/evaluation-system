<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Semester extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester', function (Blueprint $table) {
            $table->id();
            $table->string('semesterDescription')->unique();
            $table->timestamps();
        });

        $now = new DateTime();

        DB::table('semester')->insert([
            'semesterDescription' => '1st semester',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semester');
    }
}
