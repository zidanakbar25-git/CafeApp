<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'sub_id', 'name', 'description', 'price', 'image_url', 'is_active',
    ];

    public function subCategory()
    {
        // foreign key di tabel ini adalah 'sub_id'
        return $this->belongsTo(SubCategory::class, 'sub_id');
    }
}