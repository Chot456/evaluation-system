<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run() {
        DB::table('users')->truncate(); //for cleaning earlier data to avoid duplicate entries
        DB::table('users')->insert([
          'name' => 'Admin',
          'email' => 'iamadmin@gmail.com',
          'role' => 'admin',
          'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
          'name' => '',
          'email' => 'iamaseller@gmail.com',
          'role' => 'evaluator',
          'password' => Hash::make('password'),
        ]);
      }
}
