<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Logintable;
use Illuminate\Validation\ValidationException;
class MyloginController extends Controller
{
    public function login(Request $request){

//        $this->validation($request);
        if(Auth::attempt(['email' => $request->email,'password'=>$request->password])){
            $log = new Logintable();
            $log->user_id = Auth::user()->id;
            $log->login_at=now();
            $log->save();
            return view('/home');


        }
        return view('/welcome');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        return 'loged out';
        return redirect('/');
    }

    public function validation($request){
        return $this->validate($request,[
            'email'=> 'required|email',
            'password' => 'reguired'
        ]);
    }
}
