<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = [
        'title', 'start_date', 'end_date', 'place', 'progtype', 'userid', 'creatorid'
    ];
}
