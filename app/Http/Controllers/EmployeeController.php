<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return employee::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id'=>'required',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required'
        ]);
        $employee = new employee([
            'employee_id' => $request->get('employee_id'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'user_type_id' => $request->get('user_type_id'),
        ]);

        $employee->save();

        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aEmployee =  employee::findOrFail($id);
        
        $aVariables = [
            $aEmployee,
            $aEmployee->userType
        ];
        
        return response()->json(['response' => 'success', 'data' => $aVariables]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = employee::findOrFail($id);

        $employee->employee_id = $request->employee_id;
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->user_type_id = $request->user_type_id;

        if($employee->save()) {
            return response()->json($employee, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        //
    }

    public function filterByIdAndUserTypeId($userTypeId) {
        return employee::all()->where('usertype_id', 'userTypeId');
    }

    public function getEmployeeByIdUserType($id, $user_type_id) {
        $res = DB::table('employee')
        ->select('*')
        ->join('user_type', 'employee.id', '=', 'user_type.id')
        ->where('employee.user_type_id', $id)
        ->where('employee.user_type_id', $user_type_id)
        ->get();

        return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function getEmployeeByUserType() {
        $res = DB::table('employee')
        ->select('*')
        ->join('user_type', 'employee.id', '=', 'user_type.id')
        ->where('employee.user_type_id', $user_type_id)
        ->get();

        return response()->json(['response' => 'success', 'data' => $res]);
    }
}
