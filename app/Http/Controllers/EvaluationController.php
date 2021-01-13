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
        ->join('questionaire', 'questionaire.id', '=', 'evaluation.questionaireId')
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
            'questionaireId'=>'required',
        ]);

        
        $evaluation = new evaluation([
            'evaluatorId' => $request->get('evaluatorId'),
            'employee_id' => $request->get('employee_id'),
            'questionaireId' => $request->get('questionaireId'),
            'rating' => $request->get('rating'),
            'evaluationDate' => $request->get('evaluationDate'),
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
        //return evaluation::findOrFail($id);
        return $result = DB::table('evaluation')
        ->select('*')
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
        ->join('questionaire', 'questionaire.id', '=', 'evaluation.questionaireId')
        ->where('evaluation.evaluatorId', $id)
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
        $evaluation = evaluation::findOrFail($id);
        $evaluation->evaluatorId = $request->evaluatorId;
        $evaluation->employee_id = $request->employee_id;
        $evaluation->questionaireId = $request->questionaireId;
        $evaluation->rating = $request->rating;
        $evaluation->userTypeDescription = $request->userTypeDescription;

        if($evaluation->save()) {
            return response()->json($evaluation, 201);
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
}
