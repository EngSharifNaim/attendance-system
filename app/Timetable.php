<?php

namespace App;

use App\Department;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public function Department(){
        return $this->belongsTo('Department');
    }
}
