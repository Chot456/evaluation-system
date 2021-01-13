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
    public function show($id, $subjCode)
    {   
        // SELECT  section.studid,student.firstname, student.lastname,student.coursedescription,student.yeardescription, subject.subjDesc FROM student
        // INNER JOIN section ON section.studid = student.studid
        // inner join employee ON employee.id = section.employee_id
        // inner JOIN subject ON subject.subjCode = section.subjCode 
        // WHERE student.studid = 'S0001'

        // SELECT  section.studid,student.firstname, student.lastname,student.coursedescription,student.yeardescription, subject.subjDesc FROM student
        // INNER JOIN section ON section.studid = student.studid
        // inner join employee ON employee.id = section.employee_id
        // inner JOIN subject ON subject.subjCode = section.subjCode 
        // WHERE student.studid = 'S0001' AND section.subjCode = '712'


        // return student::findOrFail($id);
        $res = DB::table('student')
            ->select('section.studid, student.firstname, student.lastname, student.coursedescription, student.yeardescription, section.subjcode')
            ->join('section', 'section.studId', '=', 'student.studId')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->join('subject', 'subject.subjCode', '=', 'section.subjCode ')
            ->where('student.studId', $id)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function studentTransaction($id, $subjCode) {
        $res = DB::table('student')
            ->select('section.studid, student.firstname, student.lastname, student.coursedescription, student.yeardescription, section.subjcode')
            ->join('section', 'section.studId', '=', 'student.studId')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->join('subject', 'subject.subjCode', '=', 'section.subjCode ')
            ->where('student.studId', $id)->and('section.subjCode', $subjCode)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function getRecordsToEvaluate($id)
    {
        // SELECT section_code, CONCAT_WS(" ", firstname, lastname) as NAME, userTypeDescription  FROM section
		// inner join employee ON employee.id = section.employee_id
        // left JOIN user_type ON user_type.id = employee.id

        // SELECT section_code, CONCAT_WS(" ", firstname, lastname) as NAME, userTypeDescription  FROM section
		// inner join employee ON employee.id = section.employee_id
		// left JOIN user_type ON user_type.id = employee.id
		// LEFT JOIN evaluation ON evaluation.employee_id = section.employee_id
		// WHERE section.studid = 'S0001' AND evaluation.publsh = 'yes'
        
        return DB::table('section')
        ->select('section.section_code', 'employee.firstname', 'employee.lastname', 'user_type.userTypeDescription') 
        ->leftjoin('employee', 'employee.id', '=', 'section.employee_id')
        ->leftjoin('user_type', 'user_type.id', '=', 'employee.id')
        ->leftjoin('evaluation', 'evaluation.employee_id', '=', 'section.employee_id')
        ->where('section.studId', $id)
        ->where('evaluation.publish', '!=', 'yes')
        ->get();
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
