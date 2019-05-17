<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public function subject_type()
    {
        return explode('\\', $this->subject_type)[1];
    }
}
