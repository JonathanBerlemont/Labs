<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use RecordActivity;

    protected $recordableEvents = ['deleted'];
    
    protected $fillable = [
        'name', 'email', 'subject', 'message', 'read'
    ];
}