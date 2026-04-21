<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        

        $menus = [
            // MAIN COURSE (Food)
            ['Main Course', 'Nasi Goreng Spesial', 'Fried rice with egg, chicken, and vegetables', 35000],
            ['Main Course', 'Nasi Goreng Seafood', 'Fried rice with shrimp and squid', 42000],
            ['Main Course', 'Nasi Ayam Geprek', 'Crispy smashed chicken with steamed rice', 38000],
            ['Main Course', 'Mie Goreng Spesial', 'Stir-fried noodles with egg and veggies', 32000],
            ['Main Course', 'Kwetiau Goreng', 'Stir-fried flat rice noodles', 33000],
            ['Main Course', 'Spaghetti Bolognese', 'Classic beef bolognese sauce', 45000],
            ['Main Course', 'Carbonara', 'Creamy carbonara with smoked beef', 48000],
            ['Main Course', 'French Toast', 'Classic french toast with maple syrup', 28000],
            ['Main Course', 'Avocado Toast', 'Sourdough toast topped with smashed avocado', 35000],

            // DESSERT (Food)
            ['Dessert', 'Tiramisu', 'Italian coffee-flavoured dessert', 45000],
            ['Dessert', 'Cheesecake Slice', 'New York style baked cheesecake', 42000],
            ['Dessert', 'Chocolate Lava Cake', 'Warm chocolate cake with molten center', 38000],
            ['Dessert', 'Vanilla Scoop', 'Classic vanilla ice cream, 2 scoops', 22000],
            ['Dessert', 'Affogato', 'Vanilla ice cream drowned in espresso', 35000],
            ['Dessert', 'Crème Brûlée', 'Classic French baked custard', 38000],
            ['Dessert', 'Panna Cotta', 'Italian cream pudding with berry coulis', 35000],

            // COFFEE (Drink)
            ['Coffee', 'Espresso', 'Single / Double shot espresso', 22000],
            ['Coffee', 'Cappuccino', 'Espresso with steamed milk and foam', 28000],
            ['Coffee', 'Cafe Latte', 'Espresso with steamed milk', 30000],
            ['Coffee', 'Iced Americano', 'Cold brew espresso with water and ice', 28000],
            ['Coffee', 'Iced Latte', 'Espresso with cold milk over ice', 32000],
            ['Coffee', 'Cold Brew', '12-hour cold-steeped coffee', 35000],

            // NON-COFFEE (Drink)
            ['Non-Coffee', 'Matcha Latte', 'Japanese matcha with steamed milk', 32000],
            ['Non-Coffee', 'Taro Latte', 'Purple taro with milk', 32000],
            ['Non-Coffee', 'Chocolate', 'Rich hot / iced chocolate', 28000],
            ['Non-Coffee', 'Orange Juice', 'Fresh-squeezed orange juice', 25000],
            ['Non-Coffee', 'Watermelon Juice', 'Fresh watermelon blend', 22000],
            ['Non-Coffee', 'Mixed Berry Smoothie', 'Strawberry, blueberry, and raspberry blend', 38000],
            ['Non-Coffee', 'English Breakfast Tea', 'Classic black tea with milk', 22000],
            ['Non-Coffee', 'Chamomile Tea', 'Relaxing herbal chamomile tea', 22000],
        ];

        $rows = [];

        foreach ($menus as [$subName, $name, $desc, $price]) {

            $sub = DB::table('sub_categories')
                ->where('name', $subName)
                ->first();

            if (!$sub) continue;

            $rows[] = [
                'sub_id'      => $sub->sub_id,
                'name'        => $name,
                'description' => $desc,
                'price'       => $price,
                'image_url' => 'images/menu/default.jpg',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('menus')->insert($rows);
    }
}