<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('admins')->insert([
            'name' => 'TehPeteh',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
        ]);
    }
}
