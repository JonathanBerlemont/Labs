<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Blog;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function blogs()
    {
        $blogs = Blog::where('tags', 'like', "%\"{$this->name}\"%")->paginate(3);
        return $blogs;
    }
}
