<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    protected $table = 'zooms';

    protected $fillable = [
        'topic', 'start_time', 'end_time'
    ];
}
