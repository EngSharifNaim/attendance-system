<?php

namespace App\Http\Controllers;
use App\Department;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Constraint;
class ConstraintController extends Controller
{
    public function editConstraint(Request $request){
//        return $request;
        $data = array('value'=>$request->value,'name'=>$request->name);
        $id=$request->id;
        DB::table('constraints')
            ->where('id', $id)
            ->update($data);

        $departments=DB::table('departments')
            ->orderBy('id')
            ->get();
        $constraints=Constraint::all();
        $employees=User::all();
        $editConstraintMsg = 'لقد تم تعديل قيمة الثوابت بنجاح ...';
        return view('pages.constraints',compact('departments','constraints','employees','editConstraintMsg'));
    }
    public function editDepartment(Request $request){
//        return $request;
        $data = array('name'=>$request->name,'timein'=>$request->timein,'timeout'=>$request->timeout);
        $id=$request->id;
        DB::table('departments')
            ->where('id', $id)
            ->update($data);

        $departments=DB::table('departments')
            ->orderBy('id')
            ->get();
        $constraints=Constraint::all();
        $employees=User::all();
        $DepartmentMsg='لقد تم التعديل على البيانات بنجاح ...';
        return view('pages.constraints',compact('departments','constraints','employees','DepartmentMsg'));

    }
    public function addDepartment(Request $request){
        $dept=new Department();

        $dept['name'] = $request->name;
        $dept['timein'] = $request->timein;
        $dept['timeout'] = $request->timein;
        $dept->save();

        $departments=DB::table('departments')
            ->orderBy('id')
            ->get();
        $constraints=Constraint::all();
        $employees=User::all();
        $DepartmentMsg='لقد تمت اضافة الفئة بنجاح ...';
        return view('pages.constraints',compact('departments','constraints','employees','DepartmentMsg'));

    }
    public function deleteDepartment($id){
//        return $id;
        DB::table('departments')->where('id', '=', $id)->delete();

        $departments=DB::table('departments')
            ->orderBy('id')
            ->get();
        $constraints=Constraint::all();
        $employees=User::all();
        $DepartmentMsg='تمت عملية الحذف بنجاح ...';
        return view('pages.constraints',compact('departments','constraints','employees','DepartmentMsg'));

    }
    public function editEmployeeDepartment(Request $request){
//        return $request;
        $data = array('department_id'=>$request->department);
        $id=$request->employee;
        DB::table('users')
            ->where('id', $id)
            ->update($data);

        $departments=DB::table('departments')
            ->orderBy('id')
            ->get();
        $constraints=Constraint::all();
        $employees=User::all();
        $editEmployeeDepartmentMsg='لقد تم التعديل فئة الموظف بنجاج ...';
        return view('pages.constraints',compact('departments','constraints','employees','editEmployeeDepartmentMsg'));

    }
}
