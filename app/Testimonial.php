<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use RecordActivity;

    protected $recordableEvents = ['created', 'deleted'];
    
    protected $fillable = [
        'name', 'job', 'message'
    ];
}
