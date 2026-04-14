<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $primaryKey = 'sub_id'; // dari fix sebelumnya

    protected $fillable = ['category_id', 'name'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
        //                                         ^FK di tabel ini  ^PK di tabel categories
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'sub_id', 'sub_id');
    }
}