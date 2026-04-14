<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        // category_id is based on CategorySeeder insertion order:
        // 1 = Food | 2 = Beverage | 3 = Dessert | 4 = Snack

        $map = [
            1 => ['Main Course', 'Dessert'], // Food
            2 => ['Coffee', 'Non Coffee'],   // Drink
        ];

        $rows = [];
        foreach ($map as $categoryId => $subs) {
            foreach ($subs as $name) {
                $rows[] = [
                    'category_id' => $categoryId,
                    'name'        => $name,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }

        DB::table('sub_categories')->insert($rows);
    }
}