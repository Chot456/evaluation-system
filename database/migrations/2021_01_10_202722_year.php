<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Year extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year', function (Blueprint $table) {
            $table->id();
            $table->string('yearDescription');
            $table->timestamps();
        });

        $year_desc = [
            '1st Year',
            '2nd Year',
            '3rd Year',
            '4th Year'
        ];
        
        $now = new DateTime();

        foreach($year_desc as $year) {
            DB::table('year')->insert([
                'yearDescription' => $year,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yearDescription');
    }
}
