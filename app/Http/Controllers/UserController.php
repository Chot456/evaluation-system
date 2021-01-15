<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSession()
    {
        $admin = Auth::user();
        dd(Auth::user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::id();
    }

    public function getSession2() {
        $userID = Auth::id();

        if (Auth::check()) {
            return "User logged , user_id : ".$userID ;
        }else{
            return "Not logged"; //It is returning this
        }
    }
}
