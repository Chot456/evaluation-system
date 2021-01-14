<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::id();
    }

    public function createUser(Request $request) 
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'roles' => $request['roles'],
            'password' => Hash::make('password'),
        ]);
    }

    /**
     * 
     */
    public function getUser()
    {
        return User::all();
    }

    /**
     * 
     */
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * 
     */
    public function getUserByRole($role)
    {
         return DB::table('users')
         ->select('*')
         ->where('role', $role)
         ->get();
    }

    /**
     * 
     */
    public function updateUser(Request $request, $id) {
        $user =  User::findOrFail($id);

        dd($request);
        $user->name = $request->faculty_name;
        $user->email = $request->employee_id;
        $user->roles = $request->roles;

        if($request->user_id) {
            $user->user_id = $request->user_id;
        }
       
        if($user->save()) {
            return response()->json($user, 201);
        }
    }
}
