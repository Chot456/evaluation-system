<?php

namespace App\Http\Controllers;

use App\Models\evaluationSummary;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\evaluationSummary  $evaluationSummary
     * @return \Illuminate\Http\Response
     */
    public function show(evaluationSummary $evaluationSummary)
    {
        //
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
