<?php

namespace App\Http\Controllers;
use DateTime;
use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Constraint;
use App\Logintable;
use App\Timetable;
use App\Message;
use App\setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Null_;
use App\Imports\CsvImport;
use Excel;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function timeToInt($data){
        $arr = explode(':',$data);


        return ($arr[0] * 60 * 60) + ($arr[1] * 60) + ($arr[2]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return  view('home');

    }

    public function generelReport(){

        $logs=Logintable::where('logout','<>',null)->orderBy('user_id')->orderBy('logout','DESC')->paginate(200);
//        return $logs;
        $employees=User::select('*')
//            ->join('logintables','users.id','=','logintables.user_id')
            ->with('Department')
            ->paginate(50);
//        return $employees;
        $atEmployees=Logintable::where('logout','=',null)->with('User')->get();
        $status='Attended Now ';
        $action='main';
        return view('generalReport',compact('employees','atEmployees','logs','status','action'));

    }

    public function importXL(Request $request){

//        return $request->file('import_file');
        $file = fopen($request->file('import_file')->getRealPath(), "r");
//        $file = $request->file('import_file');
//        return fgets($file);

        DB::table('logintables')->delete();
        while(!feof($file)) {
            $line = fgets($file);
            if (strlen($line) > 0) {
                $data = str_replace(' ', '', $line);
                if (strlen($data) == 30) {
                    $employee = substr($data, 0, 1);
                    $date = substr($data, 2, 10);
                    $time = substr($data, 12, 8);
                    $action = substr($data, 23, 1);

                } else {
                    $employee = substr($data, 0, 2);
                    $date = substr($data, 2, 11);
                    $time = substr($data, 13, 8);
                    $action = substr($data, 24, 1);


                }
            }
                $log = Logintable::where('user_id',$employee)->where('log_date',date('Y-m-d', strtotime($date)))->where('logout',Null)->first();
            if($log)
            {
                if($action == 1) {
//                    return $this->makeTime($this->timeToInt(Carbon::parse(date('H:i:s',strtotime($time)))->format('H:i:s')) - $this->timeToInt((Carbon::parse(date('H:i:s',strtotime($log->login_at)))->format('H:i:s')))) ;

//                   return Carbon::parse($time)->format('H:i:s');
                   $log->logout = $this->makeTime($this->timeToInt(Carbon::parse(date('H:i:s',strtotime($time)))->format('H:i:s')));
//                   $log->timein = Carbon::parse($time)->format('H:i:s');
                    $log->duration = $this->timeToInt(Carbon::parse(date('H:i:s',strtotime($time)))->format('H:i:s')) - $this->timeToInt((Carbon::parse(date('H:i:s',strtotime($log->login_at)))->format('H:i:s'))) ;
                    $log->save();
                }
            }
            else
                {
                    $inTime = User::select('*')
                        ->where('id',$employee)
                        ->with('Department')->first();
                    $inTime = $inTime->Department->timein;

                    $log = new Logintable();
                    $log->login_at = date('H:i:s', strtotime($time));
//                    $log->logout = Null;
                    $log->user_id = $employee;
                    $log->log_date = date('Y-m-d', strtotime($date));
                    $log->late = $this->timeToInt(Carbon::parse(date('H:i:s',strtotime($time)))->format('H:i:s')) - $this->timeToInt((Carbon::parse(date('H:i:s',strtotime($inTime)))->format('H:i:s'))) ;

                $log->save();
                }

//            }
        }
//       return 'done';


        return $this->generelReport();
//        $employees=User::where('employee','=','1')->get();
//
//        return view('employeeList')
//            ->with('msg','The Excel file hase Imported successfuly')
//            ->with('employees',$employees);


    }
    public function exportXL($type){

        $data = collect(Logintable::select('users.name','users.login_id','logintables.created_at','logintables.logout','logintables.duration','logintables.late','logintables.overtime')
            ->join('users','users.login_id','=','logintables.user_id')
            ->orderBy('users.login_id')
            ->get()
            ->toArray()
        );
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);

    }
    public function collection(){
        $data=collect(Logintable::where('id','>',0)->with('User')->get());

        return $data;
        /* filter collector


                $filter = $data->filter(function($value, $key) {
                    if ($value['user_id'] == 1001) {
                        return true;
                    }
                });

                $filter->all();
                dd($filter);
        */
        $each = $data->each(function($item,$key){
            if($key == 100) {
                return false;
            }
        });
        dd($each);

    }
    public function setting(){
        $departments=DB::table('departments')
            ->orderBy('id')
            ->get();
        $constraints=Constraint::all();
        $employees=User::all();
        return view('pages.constraints',compact('departments','constraints','employees'));
    }
    public function createEmployee(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'login_id' => 'required|unique:users',
        ]);

        $employee= new User();
        $employee['name'] = $request->name;
        $employee['login_id'] = $request->login_id;
        $employee['email'] = $request->email;
        $employee->save();

        $employees=User::where('employee','=','1')->paginate(20);
        return view('employeeList',compact('employees'));

    }
    public function deleteEmployee(Request $request){

        User::where('id',$request->id)->delete();
        return $request->all();
    }
    public function employeeList(){
        $employees=User::where('employee','=','1')->paginate(50);
        $status='Main ';
        return view('employeeList',compact('employees','status'));
    }

    public function employeeFilter(Request $request){
//        $logs=Logintable::where('user_id','=',$request->user_id)->get();
//        return $request;
        $logs = Logintable::where('user_id', $request->user_id)->where('created_at','>=',$request->start_date)->with('User')->paginate(50);
        $employee=User::where('login_id','=',$request->user_id)->first();
        $status=  $employee->name . ' - ';
        return view('admin',compact('logs','status'));

    }
    public function attendedEmployee(){
        $employees=Logintable::where('logout','=',null)->with('User')->get();
        $status='Attended Now ';
        return view('employee',compact('employees','status'));


    }

    public function generalRepotfilter(Request $request){

        $day = date('d', strtotime($request->start_date));
        $month = date('m', strtotime($request->start_date));
        $year = date('y', strtotime($request->start_date));
        $from= $year . '-' . $month . '-' . $day;

        $day = date('d', strtotime($request->end_date));
        $month = date('m', strtotime($request->end_date));
        $year = date('y', strtotime($request->end_date));
        $to= $year . '-' . $month . '-' . $day;

        $from= date('Y-m-d',strtotime($from));
        $to= date('Y-m-d',strtotime($to));

        $logs=Logintable::where('logout','<>',null)
            ->whereBetween('created_at',[$from,$to])
            ->orderBy('user_id')
            ->paginate(50);
//return $logs;
        $employees=User::paginate(50);

//        return $employees;
        $atEmployees=Logintable::where('logout','=',null)->with('User')->get();
        $status='Attended Now ';
//    return $atEmployees;
        return view('generalReport',compact('employees','atEmployees','logs','status'));
    }

    public function read(){
        $file = fopen(storage_path("attlog.dat"), "r");


        while(!feof($file)) {
            $line = fgets($file);
            if(strlen($line)>0){
                $data = str_replace(' ','',$line);
                if(strlen($data)==30)
                {
                    $employee = substr($data,0,1);
                    $date = substr($data,2,10);
                    $time = substr($data,12,8);
                    $action = substr($data,23,1);

                }
                else
                {
                    $employee = substr($data,0,2);
                    $date = substr($data,2,11);
                    $time = substr($data,13,8);
                    $action = substr($data,24,1);


                }


                echo 'Employee: ' . $employee . "<br>";
                echo 'Date: ' . $date . "<br>";
                echo 'Time: ' . $time . "<br>";
                echo 'Action: ' . $action . "<br>";
            }
        }
    }
}
