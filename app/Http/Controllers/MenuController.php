<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    // Mapping: nama category di DB → main tab yang diinginkan
    private $categoryMapping = [
        'food'     => 'food',
        'beverage' => 'drink',
        'dessert'  => 'food',
        'snack'    => 'food',
    ];

    public function index()
    {
        $menus = Menu::with('subCategory.category')
            ->where('is_active', 1)
            ->get();

        $menuData = [];

        foreach ($menus as $m) {
            $mainName = $m->subCategory?->category?->name;
            $subName  = $m->subCategory?->name;

            if (!$mainName || !$subName) continue;

            // Map ke tab yang benar
            $mainKey = $this->categoryMapping[strtolower($mainName)] ?? strtolower($mainName);
            $subKey  = strtolower($subName);

            $menuData[$mainKey][$subKey][] = [
                'name'        => $m->name,
                'description' => $m->description ?? '',
                'price'       => $m->price,
                'image_url'   => $m->image_url ?? null,
            ];
        }

        // Pastikan urutan: drink dulu, lalu food (sesuai desain)
        $ordered = [];
        foreach (['drink', 'food'] as $key) {
            if (isset($menuData[$key])) {
                $ordered[$key] = $menuData[$key];
            }
        }
        // Tambahkan key lain yang tidak ter-mapping
        foreach ($menuData as $k => $v) {
            if (!isset($ordered[$k])) $ordered[$k] = $v;
        }

        return view('customer.menu', ['menuData' => $ordered]);
    }
}