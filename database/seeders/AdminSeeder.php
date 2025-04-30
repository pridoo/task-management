<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->delete(); // ✅ safer than truncate

        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'id_number' => 'A005',
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
