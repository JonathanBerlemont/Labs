<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use RecordActivity;
    
    protected $fillable = [
        'title', 'description', 'icon_class', 'image_name'
    ];
    public function excerpt()
    {
        return Str::words($this->description, 10, '...');
    }
}
