<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>'demo',
            'email' =>'demoadmin@gmail.com',
            'role' =>'admin',
            'password' =>Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now()
           ]);
    }
}
