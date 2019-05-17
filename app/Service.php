<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use RecordActivity;
    
    protected $fillable = [
        'title', 'description', 'icon_class'
    ];
}
