<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionaireCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionaire_category', function (Blueprint $table) {
            $table->id();
            $table->string('questionCategoryDesc');
            $table->timestamps();
        });

        $now = new DateTime();
        
        DB::table('questionaire_category')->insert([
            'questionCategoryDesc' => 'sample description',
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
        Schema::dropIfExists('questionaire_category');
    }
}
