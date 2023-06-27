<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('Asdfghjkl2323@'),
                'role' => 1
            ],
            [
                'name' => 'Manager',
                'email' => 'manager123@gmail.com',
                'password' => Hash::make('Asdfghjkl2323@'),
                'role' => 2
            ],
            [
                'name' => 'Sajid',
                'email' => 'sajid123@gmail.com',
                'password' => Hash::make('Asdfghjkl2323@'),
                'role' => 3
            ],
            [
                'name' => 'Lakmal',
                'email' => 'lakmal123@gmail.com',
                'password' => Hash::make('Asdfghjkl2323@'),
                'role' => 4
            ],
            [
                'name' => 'Achintha',
                'email' => 'achintha123@gmail.com',
                'password' => Hash::make('Asdfghjkl2323@'),
                'role' => 5
            ],
        ]);
    }
}
