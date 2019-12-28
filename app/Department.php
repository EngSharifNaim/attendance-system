<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Timetable;
class Department extends Model
{
    public function User(){
        return $this->hasMany(User::class);
    }
    public function Timetable(){
        return $this->hasMany('Timetable');
    }
}
