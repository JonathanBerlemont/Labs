<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Str;

use App\Tag;
use App\Comment;
use App\Category;
use App\User;

class Blog extends Model
{
    use RecordActivity;

    /* Variables */
    
    protected $casts = [
        'categories' => 'array',
        'tags' => 'array'
    ];

    protected $fillable = [
        'title', 'description', 'author_id', 'tags', 'categories', 'image_name'
    ];

    /* Functions */
    public function author()
    {
        return User::find($this->author_id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function excerpt()
    {
        return Str::words($this->description, $words = 15, $end='...');
    }

    public function path()
    {
        return "/blog/{$this->id}";
    }
}