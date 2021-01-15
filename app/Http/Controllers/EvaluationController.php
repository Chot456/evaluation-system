<?php

namespace App\Http\Controllers;

use App\Models\evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return evaluation::all();
        return $result = DB::table('evaluation')
        ->select('*')
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
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
            'evaluatorId'=>'required',
            'employee_id'=>'required',
        ]);

        
        $evaluation = new evaluation([
            'evaluatorId' => $request->get('evaluatorId'),
            'employee_id' => $request->get('employee_id'),
            'rating' => $request->get('rating'),
            'evaluationDate' => $request->get('evaluationDate'),
            'userTypeDescription' => $request->get('userTypeDescription'),
            'remarks' => $request->get('remarks'),
            'publish' => $request->get('publish'),
            'report' => $request->get('report'),
             'a1' => $request->get('a1'),
             'a2' => $request->get('a2'),
             'a3' => $request->get('a3'),
             'a4' => $request->get('a4'),
             'a5' => $request->get('a5'),
             'a6' => $request->get('a6'),
             'a7' => $request->get('a7'),
             'a8' => $request->get('a8'),
             'a9' => $request->get('a9'),
             'a10' => $request->get('a10'),
             'a11' => $request->get('a11'),
            'a12' => $request->get('a12'),
            'a13' => $request->get('a13'),
            'a14' => $request->get('a14'),
            'a15' => $request->get('a15'),
            'a16' => $request->get('a16'),
            'a17' => $request->get('a17'),
            'a18' => $request->get('a18'),
            'a19' => $request->get('a19'),
            'a20' => $request->get('a20')
        ]);

        $evaluation->save();

        return response()->json($evaluation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return evaluation::findOrFail($id);
        return $result = DB::table('evaluation')
        ->select('*')
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
        ->where('evaluation.id', $id)
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'evaluatorId'=>'required',
            'employee_id'=>'required'
        ]);
        $aRes = evaluation::findOrFail($id);

        $aRes->evaluatorId = $request->evaluatorId;
        $aRes->employee_id = $request->employee_id;
        $aRes->rating = $request->rating;
        $aRes->evaluationDate = $request->evaluationDate;
        $aRes->userTypeDescription = $request->userTypeDescription;
        $aRes->remarks = $request->remarks;
        $aRes->publish = $request->publish;
        $aRes->report = $request->report;
        $aRes->a1 = $request->a1;
        $aRes->a2 = $request->a2;
        $aRes->a3 = $request->a3;
        $aRes->a4 = $request->a4;
        $aRes->a5 = $request->a5;
        $aRes->a6 = $request->a6;
        $aRes->a7 = $request->a7;
        $aRes->a8 = $request->a8;
        $aRes->a9 = $request->a9;
        $aRes->a10 = $request->a10;
        $aRes->a11 = $request->a11;
        $aRes->a12 = $request->a12;
        $aRes->a13 = $request->a13;
        $aRes->a14 = $request->a14;
        $aRes->a15 = $request->a15;
        $aRes->a16 = $request->a16;
        $aRes->a17 = $request->a17;
        $aRes->a18 = $request->a18;
        $aRes->a19 = $request->a19;
        $aRes->a20 = $request->a20;
    
        $aRes->save();

        if ($aRes->save()) {
            return response()->json($aRes, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(evaluation $evaluation)
    {
        //
    }

    public function findEvaluationByEmployee($firstname)
    {
        $evaluation = DB::table('evaluation')
        ->select('*')
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
        ->where('employee.firstname', 'like', '%' . $firstname . '%')
        ->get();

        return response()->json($evaluation, 201);
    }

    public function getEvaluationByUserType()
    {
        
    }
}
