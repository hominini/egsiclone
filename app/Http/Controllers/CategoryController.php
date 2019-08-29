<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Muestra las categorías.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategories = \App\Category::where('parent_number',NULL)->get();
        return view('categories.index', compact('parentCategories'));
    }
}
