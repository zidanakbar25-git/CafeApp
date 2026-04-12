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
            $number = str_pad($i, 2, '0', STR_PAD_LEFT);
            $tables[] = [
                'table_number' => "T{$number}",
                'qr_code_url'  => "https://cafe.example.com/qr/table-{$number}-" . Str::random(8),
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('cafe_tables')->insert($tables);
    }
}