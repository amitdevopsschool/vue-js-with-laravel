<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // admin
            [
                'name'=> 'Admin',
                'username'=> 'admin',
                'email'=> 'admin@gmail.com',
                'password'=> Hash::make('111'),
                'role'=> 'admin',
                'status'=> 'active',
            ],
            // vendor
            [
                'name' => 'Ariyan Vendor',
                'username'=> 'vendor',
                'email'=> 'vendor@gmail.com',
                'password'=> Hash::make(111),
                'role'=> 'vendor',
                'status'=> 'active',
            ],
            [
                'name' => 'User',
                'username'=> 'user',
                'email'=> 'user@gmail.com',
                'password'=> Hash::make(111),
                'role'=> 'user',
                'status'=> 'active',
            ],
        ]);
    }

}
