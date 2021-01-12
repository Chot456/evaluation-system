<?php

namespace App\Http\Controllers;

use App\Models\evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return evaluation::all();
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
            'profId'=>'required',
            'questionaireId'=>'required',
            'rating'=>'required'
        ]);
        $evaluation = new evaluation([
            'evaluatorId' => $request->get('evaluatorId'),
            'profId' => $request->get('profId'),
            'questionaireId' => $request->get('questionaireId'),
            'rating' => $request->get('rating')
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
        return evaluation::findOrFail($id);
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
        $evaluation->profId = $request->profId;
        $evaluation->questionaireId = $request->questionaireId;
        $evaluation->rating = $request->rating;

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
