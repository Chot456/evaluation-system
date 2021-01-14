<?php

namespace App\Http\Controllers;

use App\Models\faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM faculty
        // INNER JOIN employee
        // ON faculty.employee_id = employee.id
        // INNER JOIN user_type
        // ON employee.user_type_id = user_type.id

        return DB::table('faculty')
        ->select('*')
        ->join('employee', 'faculty.employee_id', '=', 'employee.id')
        ->join('user_type', 'employee.id', '=', 'user_type.id')
        ->get();
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
            'faculty_name'=>'required',
            'employee_id'=>'required',
        ]);

        $aRes = new faculty([
            'faculty_name' => $request->get('faculty_name'),
            'employee_id' => $request->get('employee_id'),
        ]);

        $aRes->save();

        return response()->json($aRes, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return DB::table('faculty')
        ->select('*')
        ->join('employee', 'faculty.employee_id', '=', 'employee.id')
        ->join('user_type', 'employee.id', '=', 'user_type.id')
        ->where('faculty.id', $id)
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faculty = faculty::findOrFail($id);
        $faculty->faculty_name = $request->faculty_name;
        $faculty->employee_id = $request->employee_id;

        if($faculty->save()) {
            return response()->json($faculty, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = faculty::findOrFail($id);

        if ($faculty->delete()) {
            return response()->json("one record has been deleted!", 204);
        }
    }
}
