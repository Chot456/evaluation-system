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
            'rating'=>'required'
        ]);
        $evaluation = new evaluation([
            'evaluatorId' => $request->get('evaluatorId'),
            'employee_id' => $request->get('employee_id'),
            'questionaireId' => $request->get('questionaireId'),
            'rating' => $request->get('rating'),
            'userTypeDescription' => $request->get('userTypeDescription')
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
