<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    function login() 
    {
        return view('auth.user-login');
    }

    function register() 
    {
        return view('auth.user-register');
    }

    function check(Request $request) 
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', '=', $request->email)->first();
    
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $aRes = DB::table('users')
                    ->select('*')
                    ->leftjoin('employee', 'users.id', '=', 'employee.user_id')
                    ->leftjoin('student', 'users.id', '=', 'student.user_id')
                    ->leftjoin('faculty', 'employee.id', '=', 'faculty.employee_id')
                    ->where('users.id', $user->id)
                    ->get();
                    
                $request->session()->put('LoggedUser', $aRes);
                return redirect('Evaluator#/EvaluatorMain');

                // if (session('LoggedUser')->roles) {
                //     if (session('LoggedUser')->roles == 'evaluator'){
                //         // evaluator
                //         return redirect('evaluate#/EvaluatorMain');
                //     } else {
                //         return redirect('home');
                //     }
                // }
            } else {
                return back()->with('fail', 'invalid password!');
            }
        }else {
            return back()->with('fail', 'invalid email');
        }
    }
    
    function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->roles = 'evaluator';
        
        $query = $user->save();

        if ($query) {
            return redirect('userLogin');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
    
    public function logOut() {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('userLogin');
        }
        return redirect('userLogin');
    }
}