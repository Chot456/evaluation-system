<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $user = User::where('email', '=', $request->email)->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $request->session()->put('LoggedUser', $user);
                return redirect('home');

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
    
    function logOut() {

        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('userLogin');
        }
    }
}
