<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use RecordActivity;

    protected $recordableEvents = ['deleted'];

    protected $fillable = ['email'];
}
