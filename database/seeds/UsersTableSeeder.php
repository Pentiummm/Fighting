<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
   {
      DB::table('users')->insert([
      	'name' => 'Hùng Bun',
      	'email' => 'admin@admin.com',
      	'password' => bcrypt('admin@admin.com'),
      	'admin' => 1,
      ]);
   }
}
