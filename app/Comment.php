<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name', 'blog_id', 'subject', 'message', 'email'
    ];
}
