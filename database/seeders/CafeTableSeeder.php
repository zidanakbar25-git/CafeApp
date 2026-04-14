<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CafeTableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [];
        for ($i = 1; $i <= 10; $i++) {
            DB::table('cafe_tables')->insert([
            'table_number' => "T$i",
            'qr_token' => Str::uuid(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
}

        DB::table('cafe_tables')->insert($tables);
    }
}