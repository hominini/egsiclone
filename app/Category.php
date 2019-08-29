<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    // relacion recursiva hacia una subcategoría
    public function subcategories()
    {
        return $this->hasMany('App\Category', 'parent_number', 'number');
    }

    // obtiene la categoría padre
    public function getParent()
    {
        return Category::where('number', $this->parent_number)->first();
    }
}
