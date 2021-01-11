<?php

namespace App\Http\Controllers;

use App\Models\questionaire;
use Illuminate\Http\Request;

class QuestionaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return questionaire::all();
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
            'questionDescription'=>'required',
            'userTypeId'=>'required'
        ]);
        $questionaire = new questionaire([
            'questionDescription' => $request->get('questionDescription'),
            'userTypeId' => $request->get('userTypeId'),
        ]);
        $questionaire->save();

        return response()->json($questionaire, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function show(questionaire $questionaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function edit(questionaire $questionaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $questionaire = questionaire::findOrFail($id);
        $questionaire->questionDescription = $request->questionDescription;
        $questionaire->userTypeId = $request->userTypeId;

        if($questionaire->save()) {
            return response()->json($questionaire, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\questionaire  $questionaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(questionaire $questionaire)
    {
        //
    }

    public function getQuestionaireByUserType($userTypeId) {

        return questionaire::where('userTypeId', $userTypeId)->get();
    }
}
