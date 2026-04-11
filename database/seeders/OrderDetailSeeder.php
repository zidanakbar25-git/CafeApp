<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        // [order_id, menu_id, quantity, unit_price]
        // menu_id references MenuSeeder insertion order
        $details = [
            // Order 1 – Budi Santoso
            [1,  1, 2, 35000],  // Nasi Goreng Spesial x2
            [1, 12, 2, 30000],  // Cafe Latte x2
            [1, 31, 1, 25000],  // French Fries x1

            // Order 2 – Siti Rahayu
            [2,  4, 1, 32000],  // Mie Goreng Spesial x1
            [2, 14, 1, 32000],  // Iced Latte x1
            [2, 25, 1, 42000],  // Cheesecake Slice x1

            // Order 3 – Ahmad Fauzi
            [3,  8, 1, 45000],  // Spaghetti Bolognese x1
            [3, 15, 1, 35000],  // Cold Brew x1
            [3, 16, 1, 32000],  // Matcha Latte x1

            // Order 4 – Dewi Lestari
            [4,  7, 1, 35000],  // Avocado Toast x1
            [4, 17, 1, 32000],  // Taro Latte x1

            // Order 5 – Rizky Pratama
            [5,  3, 2, 38000],  // Nasi Ayam Geprek x2
            [5,  9, 1, 48000],  // Carbonara x1
            [5, 21, 1, 38000],  // Mixed Berry Smoothie x1
        ];

        $rows = [];
        foreach ($details as [$orderId, $menuId, $qty, $unitPrice]) {
            $rows[] = [
                'order_id'   => $orderId,
                'menu_id'    => $menuId,
                'quantity'   => $qty,
                'unit_price' => $unitPrice,
                'subtotal'   => $qty * $unitPrice,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('order_details')->insert($rows);
    }
}