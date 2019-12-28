<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Logintable extends Model
{
    protected $fillable = ['user_id'];
    protected $casts = [
        'logout_at' => 'datetime'
    ];

    public function makeTime($data){
        $hour=0;
        $minutes=0;
        $seconds=0;
        $newminutes=0;

        $seconds = $data % 60;
        $minutes = (int)($data / 60);

        if ($minutes > 60){
            $newminutes = $minutes % 60;
            $hour = (int)($minutes / 60);
            return $hour . ':' . $newminutes .':' . $seconds;
        }
        return $hour . ':' . $minutes .':' . $seconds;

    }

    public function timeToInt($data){
        $arr = explode(':',$data);

        return ($arr[0] * 60 * 60) + ($arr[1] * 60) + ($arr[2]);
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getDurations($id){
        $totalDduration = Logintable::where('user_id','=',$id)
        ->get();
//        return $id;
        return $totalDduration->sum('duration');
    }
    public function getLates($id){
        $totalDduration = Logintable::where('user_id','=',$id)
            ->get();
//        return $id;
        return $totalDduration->sum('late');
    }
    public function getOvertimes($id){
        $totalDduration = Logintable::where('user_id','=',$id)
            ->get();
//        return $id;
        return $totalDduration->sum('overtime');
    }
}
