<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return student::all();
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
            'studId'=>'required',
            'firstName'=>'required'
        ]);
        $student = new student([
            'studId' => $request->get('studId'),
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'yearDescription' => $request->get('yearDescription'),
            'courseDescription' => $request->get('courseDescription')
        ]);
        $student->save();

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // return student::findOrFail($id);
        $res =  DB::table('student')
            ->select('*')
            ->join('section', 'student.studId', '=', 'section.studId')
            ->where('student.studId', $id)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function getRecordsToEvaluate()
    {
        // SELECT section_code, CONCAT_WS(" ", firstname, lastname) as NAME, userTypeDescription  FROM section
		// inner join employee ON employee.id = section.employee_id
        // left JOIN user_type ON user_type.id = employee.id
        
        return DB::table('section')
            ->select('*')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->leftJoin('user_type', 'user_type.id', '=', 'employee.id')
            ->get();

            // return DB::table('section')
            // ->select('*')
            // ->join('student', 'student.studId', '=', 'section.studId')
            // ->join('employee', 'employee.employee_id', '=', 'employee.employee_id')
            // ->where('student.studId', $id)
            // ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'studId'=>'required',
            'firstName'=>'required'
        ]);
        $student = student::findOrFail($id);

        $student->studId = $request->studId;
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->yearDescription = $request->yearDescription;
        $student->courseDescription = $request->courseDescription;
    
        $student->save();

        if ($student->save()) {
            return response()->json($student, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
        //
    }
}
