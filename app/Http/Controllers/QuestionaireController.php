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
            'questionCategoryId' => $request->get('questionCategoryId'),
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
    public function show($id)
    {
        return questionaire::findOrFail($id);
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
        $questionaire->questionCategoryId = $request->questionCategoryId;

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
    public function destroy($id)
    {
        $aData = department::findOrFail($id);

        if ($aData->delete()) {
            return response()->json("one record has been deleted!", 204);
        }
    }

    public function getQuestionaireByUserType($userTypeId) {

        return questionaire::where('userTypeId', $userTypeId)->get();
    }
}
