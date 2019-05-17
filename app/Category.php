<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Blog;

class Category extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function blogs()
    {
        $blogs = Blog::where('categories', 'like', "%\"{$this->name}\"%")->paginate(3);
        return $blogs;
    }
}