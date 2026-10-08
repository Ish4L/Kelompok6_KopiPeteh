<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'TehPeteh',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
        ]);
    }
}
