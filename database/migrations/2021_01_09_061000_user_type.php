<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type', function (Blueprint $table) {
            $table->id();
            $table->string('userTypeDescription');
            $table->timestamps();
        });

        $user_types = [
            'student',
            'teacher',
            'dean',
            'admin'
        ];
        
        $now = new DateTime();

        foreach($user_types as $user_type) {
            DB::table('user_type')->insert([
                'userTypeDescription' => $user_type,
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
        Schema::dropIfExists('user_type');
    }
}
