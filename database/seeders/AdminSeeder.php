<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'username'      => 'superadmin',
                'password_hash' => Hash::make('superadmin123'),
                'role'          => 'super_admin',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'cashier1',
                'password_hash' => Hash::make('cashier123'),
                'role'          => 'cashier',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'username'      => 'staff1',
                'password_hash' => Hash::make('staff123'),
                'role'          => 'staff',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}