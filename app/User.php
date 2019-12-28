<?php

namespace App;

use http\Env\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Logintable;
use phpDocumentor\Reflection\Types\Null_;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','login_id', 'password',
    ];

    public function Logintable(){
        return $this->hasMany(Logintable::class,'user_id','login_id');
    }
    public function Department(){
        return $this->belongsTo(Department::class);
    }

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
    public function getDurations($id,$beginDate='',$endDate='',$exDate='')
    {
        if($exDate<>'' && $exDate <> '--'){
            $sumDuration=0;
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->get();
//            return $exDate;
            foreach ($totalDduration as $total){
                $tempTime=$total->login_at;
//                return Date('Y-m-d',strtotime($tempTime));
                if(Date('Y-m-d',strtotime($exDate)) == Date('Y-m-d',strtotime($tempTime))){

                    $sumDuration = $sumDuration + $total->duration;
                }

            }
            return $this->makeTime($sumDuration);
        }
            if ($beginDate <> '' && $beginDate <> '--' && $endDate <> '' && $endDate <> '--') {
                $totalDduration = Logintable::where('user_id', '=', $id)
                    ->whereBetween('log_date', [$beginDate, $endDate])
                    ->get();
                return $this->makeTime($totalDduration->sum('duration'));
            }
            if ($beginDate <> '' && $beginDate <> '--') {
                $totalDduration = Logintable::where('user_id', '=', $id)
                    ->where('login_at', '>', $beginDate)
                    ->get();
                return $this->makeTime($totalDduration->sum('duration'));
            }
            if ($endDate <> '' && $endDate <> '--') {
                $totalDduration = Logintable::where('user_id', '=', $id)
                    ->where('login_at', '<', $endDate)
                    ->get();
                return $this->makeTime($totalDduration->sum('duration'));
            }

        $totalDduration = Logintable::where('user_id', '=', $id)
            ->get();
        return $this->makeTime($totalDduration->sum('duration'));
//        return $id;

    }



    public function timeToInt($data){
        $arr = explode(':',$data);

        return ($arr[0] * 60 * 60) + ($arr[1] * 60) + ($arr[2]);
    }

    public function getLates($id,$beginDate='',$endDate='',$exDate=''){
        if($exDate <> '' && $exDate <> '--'){
            $sumDuration=0;
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->get();
//            return $exDate;
            foreach ($totalDduration as $total){
                $tempTime=$total->login_at;
//                return Date('Y-m-d',strtotime($tempTime));
                if(Date('Y-m-d',strtotime($exDate)) == Date('Y-m-d',strtotime($tempTime))){

                    $sumDuration = $sumDuration + $total->late;
                }

            }
            return $this->makeTime($sumDuration);
        }

        if ($beginDate <> '' && $beginDate <> '--' && $endDate <> '' && $endDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->whereBetween('login_at', [$beginDate, $endDate])
                ->get();
            return $this->makeTime($totalDduration->sum('late'));
        }
        if ($beginDate <> '' && $beginDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->where('login_at', '>', $beginDate)
                ->get();
            return $this->makeTime($totalDduration->sum('late'));
        }
        if ($endDate <> '' && $endDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->where('login_at', '<', $endDate)
                ->get();
            return $this->makeTime($totalDduration->sum('late'));
        }

        $totalDduration = Logintable::where('user_id', '=', $id)
            ->get();
        return $this->makeTime($totalDduration->sum('late'));
    }


    public function getPreOut($id,$beginDate='',$endDate='',$exDate=''){
        if($exDate <> '' && $exDate <> '--'){
            $sumDuration=0;
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->get();
//            return $exDate;
            foreach ($totalDduration as $total){
                $tempTime=$total->login_at;
//                return Date('Y-m-d',strtotime($tempTime));
                if(Date('Y-m-d',strtotime($exDate)) == Date('Y-m-d',strtotime($tempTime))){
                    $sumDuration = $sumDuration + $total->preout;
                }

            }

            return $this->makeTime($sumDuration);
        }
        if ($beginDate <> '' && $beginDate <> '--' && $endDate <> '' && $endDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->whereBetween('login_at', [$beginDate, $endDate])
                ->get();
            return $this->makeTime($totalDduration->sum('preout'));
        }
        if ($beginDate <> '' && $beginDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->where('login_at', '>', $beginDate)
                ->get();
            return $this->makeTime($totalDduration->sum('preout'));
        }
        if ($endDate <> '' && $endDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->where('login_at', '<', $endDate)
                ->get();
            return $this->makeTime($totalDduration->sum('preout'));
        }

        $totalDduration = Logintable::where('user_id', '=', $id)
            ->get();
        return $this->makeTime($totalDduration->sum('preout'));

    }
    public function getOvertimes($id){
        $totalDduration = Logintable::where('user_id','=',$id)
            ->get();
//        return $id;
        return $totalDduration->sum('overtime');
    }
    public function getTimeline($id){
        $logs=Logintable::where('user_id','=',$id)->paginate(50);
        return $logs;

    }
    public function absence($id)
    {
        $data = Logintable::where('user_id','=',$id)->get();
        $i = 0;
        $abs = date('d', strtotime(now()));
        $absloop = date('d', strtotime(now()));
        if ($data){
            foreach ($data as $d) {
                for ($i = 0; $i <= $absloop; $i++) {
                    $day=date('d', strtotime($d->created_at));
                    if ($day == $i) {
                        $abs--;
                    }
                }
            }
    }
        return $abs;
//        return $data->sum('duration');

    }
    public function workDays($id,$beginDate='',$endDate='',$exDate=''){
        if($exDate <> '' && $exDate <> '--'){
            $sumDuration=0;
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->get();
//            return $exDate;
            foreach ($totalDduration as $total){
                $tempTime=$total->login_at;
//                return Date('Y-m-d',strtotime($tempTime));
                if(Date('Y-m-d',strtotime($exDate)) == Date('Y-m-d',strtotime($tempTime))){

                    $sumDuration++;
                }

            }
            return $sumDuration;
        }
        if ($beginDate <> '' && $beginDate <> '--' && $endDate <> '' && $endDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->whereBetween('log_date', [$beginDate, $endDate])
                ->get();
            return $totalDduration->count();
        }
        if ($beginDate <> '' && $beginDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->where('login_at', '>', $beginDate)
                ->get();
            return $totalDduration->count();
        }
        if ($endDate <> '' && $endDate <> '--') {
            $totalDduration = Logintable::where('user_id', '=', $id)
                ->where('login_at', '<', $endDate)
                ->get();
            return $totalDduration->count();
        }

        $totalDduration = Logintable::where('user_id', '=', $id)
            ->get();
        return $totalDduration->count();

    }
    public function timeout($id){
        $data = Logintable::where('user_id','=',$id)->get();
        foreach ($data as $d){

        }
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
