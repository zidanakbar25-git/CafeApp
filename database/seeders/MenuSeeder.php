<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // sub_id is based on SubCategorySeeder insertion order:
        // 1=Rice Dishes, 2=Noodle Dishes, 3=Bread & Toast, 4=Pasta
        // 5=Hot Coffee,  6=Cold Coffee,   7=Non-Coffee,    8=Juice & Smoothies, 9=Tea
        // 10=Cake,       11=Ice Cream,    12=Pudding
        // 13=Fries & Chips, 14=Finger Food

        $menus = [
            // Rice Dishes
            [1, 'Nasi Goreng Spesial',   'Fried rice with egg, chicken, and vegetables',  35000],
            [1, 'Nasi Goreng Seafood',   'Fried rice with shrimp and squid',              42000],
            [1, 'Nasi Ayam Geprek',      'Crispy smashed chicken with steamed rice',       38000],

            // Noodle Dishes
            [2, 'Mie Goreng Spesial',    'Stir-fried noodles with egg and veggies',        32000],
            [2, 'Kwetiau Goreng',        'Stir-fried flat rice noodles',                   33000],

            // Bread & Toast
            [3, 'French Toast',          'Classic french toast with maple syrup',          28000],
            [3, 'Avocado Toast',         'Sourdough toast topped with smashed avocado',    35000],

            // Pasta
            [4, 'Spaghetti Bolognese',   'Classic beef bolognese sauce',                   45000],
            [4, 'Carbonara',             'Creamy carbonara with smoked beef',              48000],

            // Hot Coffee
            [5, 'Espresso',              'Single / Double shot espresso',                  22000],
            [5, 'Cappuccino',            'Espresso with steamed milk and foam',            28000],
            [5, 'Cafe Latte',            'Espresso with steamed milk',                     30000],

            // Cold Coffee
            [6, 'Iced Americano',        'Cold brew espresso with water and ice',          28000],
            [6, 'Iced Latte',            'Espresso with cold milk over ice',              32000],
            [6, 'Cold Brew',             '12-hour cold-steeped coffee',                    35000],

            // Non-Coffee
            [7, 'Matcha Latte',          'Japanese matcha with steamed milk',              32000],
            [7, 'Taro Latte',            'Purple taro with milk',                          32000],
            [7, 'Chocolate',             'Rich hot / iced chocolate',                      28000],

            // Juice & Smoothies
            [8, 'Orange Juice',          'Fresh-squeezed orange juice',                    25000],
            [8, 'Watermelon Juice',      'Fresh watermelon blend',                         22000],
            [8, 'Mixed Berry Smoothie',  'Strawberry, blueberry, and raspberry blend',     38000],

            // Tea
            [9, 'English Breakfast Tea', 'Classic black tea with milk',                    22000],
            [9, 'Chamomile Tea',         'Relaxing herbal chamomile tea',                  22000],

            // Cake
            [10, 'Tiramisu',             'Italian coffee-flavoured dessert',               45000],
            [10, 'Cheesecake Slice',     'New York style baked cheesecake',               42000],
            [10, 'Chocolate Lava Cake',  'Warm chocolate cake with molten center',         38000],

            // Ice Cream
            [11, 'Vanilla Scoop',        'Classic vanilla ice cream, 2 scoops',            22000],
            [11, 'Affogato',             'Vanilla ice cream drowned in espresso',          35000],

            // Pudding
            [12, 'Crème Brûlée',         'Classic French baked custard',                   38000],
            [12, 'Panna Cotta',          'Italian cream pudding with berry coulis',        35000],

            // Fries & Chips
            [13, 'French Fries',         'Crispy seasoned potato fries',                   25000],
            [13, 'Sweet Potato Fries',   'Crispy sweet potato fries',                      28000],

            // Finger Food
            [14, 'Chicken Wings (6pcs)', 'Crispy fried chicken wings',                     42000],
            [14, 'Spring Rolls',         'Crispy vegetable spring rolls (4pcs)',            28000],
        ];

        $rows = [];
        foreach ($menus as [$subId, $name, $desc, $price]) {
            $rows[] = [
                'sub_category_id' => $subId,
                'name'        => $name,
                'description' => $desc,
                'price'       => $price,
                'image_url'   => 'https://cafe.example.com/images/' . Str::slug($name) . '.jpg',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('menus')->insert($rows);
    }
}