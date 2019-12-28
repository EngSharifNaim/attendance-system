<?php

namespace App\Http\Controllers;
use App\Logintable;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class reportController extends Controller
{
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

    public function mainReport(Request $request){

        $employees=User::select('*')
            ->with('Department')
            ->get();


        if($request->search == 'search') {
            $beginDate = $request->beginYear . '-' . $request->beginMonth . '-' . $request->beginDay;
            $endDate=$request->endYear . '-' . $request->endMonth . '-' . $request->endDay;

            if ($request->employee <> 0 && $beginDate <> '--' && $endDate <> '--') {
                $employeeName=User::select('name')->where('id','=',$request->employee)->first();

                $logs = Logintable::where('logout', '<>', null)
                    ->where('user_id', '=', $request->employee)
                    ->whereBetween('log_date', [$beginDate, $endDate])
                    ->orderBy('user_id')->orderBy('log_date', 'DESC')->paginate(200);
                $totalLateTime = $this->makeTime($logs->sum('late'));
                $totalWorkTime = $this->makeTime($logs->sum('duration'));
                $numberOfDays = $logs->count();

                $status = 'Filterd Main Report ';
                $action = 'filter';
//                return $beginDate . '/' .$endDate;
                return view('reports.mainTimetable', compact('logs', 'status','totalLateTime', 'employees', 'totalWorkTime', 'action', 'employeeName', 'beginDate', 'endDate', 'numberOfDays'));


            }
            if ($request->employee == 0 && $beginDate <> '--' && $endDate <> '--') {

                $logs = Logintable::where('logout', '<>', null)
                    ->whereBetween('login_at', [$beginDate, $endDate])
                    ->orderBy('user_id')->orderBy('logout', 'DESC')->paginate(200);
                $totalLateTime = $this->makeTime($logs->sum('late'));
                $totalWorkTime = $this->makeTime($logs->sum('duration'));
                $numberOfDays = $logs->count();

                $status = 'Filterd Main Report ';
                $action = 'filter';
//                return $beginDate . '/' .$endDate;
                return view('reports.mainTimetable', compact('logs', 'status','totalLateTime', 'employees', 'totalWorkTime', 'action', 'beginDate', 'endDate', 'numberOfDays'));


            }
            if ($request->employee == 0 && $beginDate <> '--' && $endDate == '--') {

                $logs = Logintable::where('logout', '<>', null)
                    ->where('login_at','>', date('Y-m-d',strtotime($beginDate)))
                    ->orderBy('user_id')->orderBy('logout', 'DESC')->paginate(200);
                $totalLateTime = $this->makeTime($logs->sum('late'));
                $totalWorkTime = $this->makeTime($logs->sum('duration'));
                $numberOfDays = $logs->count();

                $status = 'Filterd Main Report ';
                $action = 'filter';
//                return $beginDate . '/' .$endDate;
                return view('reports.mainTimetable', compact('logs', 'status','totalLateTime', 'employees', 'totalWorkTime', 'action', 'beginDate', 'endDate', 'numberOfDays'));


            }
            if ($request->employee == 0 && $beginDate == '--' && $endDate <> '--') {

                $logs = Logintable::where('logout', '<>', null)
                    ->where('login_at','<', date('Y-m-d',strtotime($endDate)))
                    ->orderBy('user_id')->orderBy('logout', 'DESC')->paginate(200);
                $totalLateTime = $this->makeTime($logs->sum('late'));
                $totalWorkTime = $this->makeTime($logs->sum('duration'));
                $numberOfDays = $logs->count();

                $status = 'Filterd Main Report ';
                $action = 'filter';
//                return $beginDate . '/' .$endDate;
                return view('reports.mainTimetable', compact('logs', 'status','totalLateTime', 'employees', 'totalWorkTime', 'action', 'beginDate', 'endDate', 'numberOfDays'));


            }
            if ($request->employee <> 0 ) {
                $employeeName=User::select('name')->where('id','=',$request->employee)->first();

                $logs = Logintable::where('logout', '<>', null)
                    ->where('user_id', '=', $request->employee)
                    ->orderBy('user_id')->orderBy('logout', 'DESC')->paginate(200);

                $totalWorkTime = $this->makeTime($logs->sum('duration'));
                $totalLateTime = $this->makeTime($logs->sum('late'));
                $numberOfDays = $logs->count();

                $status = 'Filterd Main Report ';
                $action = 'filter';
//                return $logs;
                return view('reports.mainTimetable', compact('logs', 'status', 'employees', 'totalWorkTime','totalLateTime', 'action', 'employeeName', 'numberOfDays'));


            }
        }


        $logs=Logintable::where('logout','<>',null)->orderBy('logout','DESC')->paginate(200);
        $status='Main Report ';
        $action='main';
        return view('reports.mainTimetable',compact('logs','status','employees','action'));

    }
    public function employeeReport(){
        $employees=User::select('*')
            ->where('employee','<>',0)
            ->with('Department')->get();
        $status='Report By Employee';
        return view('reports.inOutReport',compact('employees','status'));
    }
    public function filterEmployeeReport(Request $request){
//        return $request;
        $beginDate = $request->beginYear . '-' . $request->beginMonth . '-' . $request->beginDay;
        $endDate=$request->endYear . '-' . $request->endMonth . '-' . $request->endDay;
        $exDate=$request->exYear . '-' . $request->exMonth . '-' . $request->exDay;

        $employees=User::select('*')
            ->where('employee','<>',0)
            ->with('Department')->get();
        $status='Report By Employee';
        return view('reports.inOutReport',compact('employees','status','beginDate','endDate','exDate'));
    }
}
