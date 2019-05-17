<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function show($category)
    {
        $cat = Category::where('name', $category)->get()->first();

        $blogs = $cat->blogs();
        
        return view('blog.index', ['blogs' => $blogs]);
    }
}
