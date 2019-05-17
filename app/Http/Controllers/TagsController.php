<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show($tag)
    {
        $tags = Tag::where('name', $tag)->get()->first();

        $blogs = $tags->blogs();
        
        return view('blog.index', ['blogs' => $blogs]);
    }
}
