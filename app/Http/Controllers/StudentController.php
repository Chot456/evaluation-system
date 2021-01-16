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
        dd(432);
        return student::All();
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
        $res = DB::table('student')
            ->select('section.studid', 'student.firstname', 'student.lastname', 'student.coursedescription', 'student.yeardescription', 'section.subjcode')
            ->join('section', 'section.studId', '=', 'student.studId')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->join('subject', 'subject.subjCode', '=', 'section.subjCode')
            ->where('student.studId', $id)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function studentTransaction($id, $subjCode) {        
        //Evaluator Main
        $res = DB::table('student')
            ->select('section.studid', 'student.firstname', 'student.lastname as studlastname', 'employee.firstname as employeefirstname','employee.lastname as employeelastname', 'student.yeardescription', 'subject.subjDesc' , 'user_type.userTypeDescription')
            ->join('section', 'section.studId', '=', 'student.studId')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->join('subject', 'section.subjCode', '=', 'subject.subjCode')
            ->join('user_type','user_type.id','=','employee.user_type_id')
            ->where('student.studId', $id)
            ->where('section.subjCode', $subjCode)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function getRecordsToEvaluate($id)
    {
        //$studtype = 1;
        //Evaluator main transaction
        $res = DB::table('section')
        ->select('evaluation.id as evalid','section.id','employee.id as empid'  ,'section.section_code', 'section.studId', 'section.subjCode', 'employee.user_type_id', 'employee.firstname', 'employee.lastname', 'user_type.userTypeDescription') 
        ->join('employee', 'employee.id', '=', 'section.employee_id')
        ->leftjoin('user_type', 'user_type.id', '=', 'employee.id')
        ->leftjoin('evaluation', 'evaluation.employee_id', '=', 'section.employee_id')
        ->where('section.studId', $id)
        //->where('evaluation.publish', '!=', 'yes')
        //->where('user_type.id', '!=', $studtype)
        ->where('evaluation.userTypeDescription', '=' , 'teacher' )
        ->get();

        return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function getEvaluatedRecords()
    {
        $res = DB::table('evaluation')
        ->select('employee.employee_id', 'employee.firstname', 'employee.lastname', 'evaluation.evaluationDate', 'evaluation.publish', 'evaluation.report') 
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
        ->get();

        return response()->json(['response' => 'success', 'data' => $res]);
    }

    public function getEvaluatedRecordsById($id)
    {
        $res = DB::table('evaluation')
        ->select('*') 
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
        ->where('evaluation.id', $id)
        ->get();

        return response()->json(['response' => 'success', 'data' => $res]);
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

    public function getSession(){
    
        $userID = Auth::id();

        if (Auth::check()) {
            return "User logged , user_id : ".$userID ;
        }else{
            return "Not logged"; //It is returning this
        }
    }

    public function getUserRecords($id) {
        return DB::table('users')
            ->select('*')
            ->leftjoin('employee', 'users.id', '=', 'employee.user_id')
            ->leftjoin('student', 'users.id', '=', 'student.user_id')
            ->where('users.id', $id)
            ->get();
    }
}
