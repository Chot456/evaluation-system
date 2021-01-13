<?php

namespace App\Http\Controllers;

use App\Models\evaluationSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return evaluationSummary::all();
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
            'remarks'=>'required',
            'evaluationDate'=>'required',
            'userTypeId'=>'required'
        ]);

        $evaluation = new evaluationSummary([
            'evaluatorId' => $request->get('evaluatorId'),
            'remarks' => $request->get('remarks'),
            'evaluationDate' => $request->get('evaluationDate'),
            'userTypeId' => $request->get('userTypeId'),
            'courseId' => $request->get('courseId'),
            'report' => $request->get('report'),
            'publish' => $request->get('publish'),
        ]);

        $evaluation->save();

        return response()->json($evaluation, 201);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\evaluationSummary  $evaluationSummary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $result = DB::table('evaluation')
        ->select('*')
        ->join('evaluation_summary', 'evaluation_summary.evaluatorId', '=', 'evaluation.evaluatorId')
        ->join('employee', 'evaluation.employee_id', '=', 'employee.id')
        ->where('evaluation_summary.evaluatorId', $id)
        ->get();
        $userTypeId = evaluationSummary::findOrFail($id);
        if($userTypeId === 1) {
            // student
        } else if ($userTypeId === 2) {
            // teacher
        } else if ($userTypeId === 3) {
            // dean
        } else {
            // admin
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\evaluationSummary  $evaluationSummary
     * @return \Illuminate\Http\Response
     */
    public function edit(evaluationSummary $evaluationSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\evaluationSummary  $evaluationSummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, evaluationSummary $evaluationSummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\evaluationSummary  $evaluationSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(evaluationSummary $evaluationSummary)
    {
        //
    }
}
