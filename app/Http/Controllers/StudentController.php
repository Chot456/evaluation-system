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
      
        $student = new student([
            'studId' => $request->get('studId'),
            'firstName' => $request->get('firstName'),
            'lastName' => $request->get('lastName'),
            'user_id' => $request->get('user_id'),
            'yearDescription' => $request->get('yearDescription'),
            'courseDescription' => $request->get('courseDescription'),
            'semesterDescription' => $request->get('semesterDescription')
        ]);
        $student->save();

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     *  
     * find student by Id 
        *evaluatemain
     */
    public function show($id)
    {           
        $res = DB::table('student')
            ->select('section.evaluator_id', 'student.firstname', 'student.lastname', 'student.coursedescription', 'student.yeardescription', 'section.subjcode')
            ->join('section', 'section.evaluator_id', '=', 'student.user_id')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->join('subject', 'subject.subjCode', '=', 'section.subjCode')
            ->where('student.studid', $id)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }
    


    public function studentTransaction($id, $subjCode) {        
        //Evaluator Main
        $res = DB::table('student')
            ->select('section.evaluator_id','student.user_id', 'student.firstname', 'student.lastname as studlastname', 'employee.firstname as employeefirstname','employee.lastname as employeelastname', 'student.yeardescription', 'subject.subjDesc' , 'user_type.userTypeDescription')
            ->join('section', 'section.evaluator_id', '=', 'student.user_id')
            ->join('employee', 'employee.id', '=', 'section.employee_id')
            ->join('subject', 'section.subjCode', '=', 'subject.subjCode')
            ->join('user_type','user_type.id','=','employee.user_type_id')
            ->where('student.user_id', $id)
             ->where('section.subjCode', $subjCode)
            ->get();

            return response()->json(['response' => 'success', 'data' => $res]);
    }

    /**
    * params userId
    */
    public function getRecordsToEvaluate($id)
    {
        //$studtype = 1;
        //Evaluator main transaction
        //'evaluation.id as evalid',
        //'section.id'
        $res = DB::table('section')
        ->select('section.id as evalid','section.id','employee.user_type_id','employee.id as empid'  ,'section.section_code', 'section.evaluator_id', 'section.subjCode', 'employee.user_type_id', 'employee.firstname', 'employee.lastname', 'user_type.userTypeDescription') 
        ->join('employee', 'employee.id', '=', 'section.employee_id')
        ->leftjoin('user_type', 'user_type.id', '=', 'employee.user_type_id')
        //->leftjoin('evaluation', 'evaluation.employee_id', '=', 'section.employee_id')
        ->where('section.evaluator_id', $id)
        ->where('section.publish', '!=', 'yes')
        //->where('user_type.id', '!=', $studtype)
        ->where('user_type.userTypeDescription', '=' , 'teacher')
       //->where('employee.user_type_id', '=' , 2 )
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
        $student = student::findOrFail($id);

        $student->user_id = $request->user_id;
        $student->studId = $request->studId;
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->yearDescription = $request->yearDescription;
        $student->courseDescription = $request->courseDescription;
        $student->semesterDescription = $request->semesterDescription;
    
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
