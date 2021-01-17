<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        return DB::table('users')
            ->select('*')
            ->leftjoin('employee', 'users.id', '=', 'employee.user_id')
            ->leftjoin('student', 'users.id', '=', 'student.user_id')
            ->get();
    }

    public function getUserById($id) 
    {
        return DB::table('users')
            ->select('*','users.user_id','users.user_id')
            ->leftjoin('employee', 'users.id', '=', 'employee.user_id')
            ->leftjoin('student', 'users.id', '=', 'student.user_id')
            ->where('users.id', $id)
            ->get();
    }

    public function changePassword(Request $request, $id) 
    {
        $aUser = User::findOrFail($id);

        if (Hash::check($request->current_password, $aUser->password)) {

            $aUser->password = Hash::make($request->new_password);
    
            if ($aUser->save()) {
                return response()->json($aUser, 201);
            }
        } else {
            return back()->withErrors('invalid current password');
        }
    }

    public function getUserByRole($role)
    {
        $aRes = DB::table('users')
                ->select('*')
                ->where('roles', $role)->get();

         return response()->json(['response' => 'success', 'data' => $aRes]);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $aRes = new User([
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'email' => $request->get('email'),
            'roles' => $request->get('roles')
        ]);

        $aRes->save();

        return response()->json($aRes, 201);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;

        if($user->save()) {
            return response()->json($user, 201);
        }

    }
}
