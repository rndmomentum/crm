<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $fillable = [
        'stud_id', 'first_name', 'last_name', 'ic', 'email', 'phoneno', 'membership_id', 'level_id', 'status'
    ];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
