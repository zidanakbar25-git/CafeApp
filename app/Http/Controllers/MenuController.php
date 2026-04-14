<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('subCategory.category')->get();

        $menuData = [];

        foreach ($menus as $m) {
            $main = strtolower($m->subCategory->category->name); // food / drink
            $sub  = strtolower($m->subCategory->name); // main course / coffee dll

            $menuData[$main][$sub][] = [
                'name'  => $m->name,
                'price' => $m->price,
            ];
        }

        return view('customer.menu', compact('menuData'));
    }
}