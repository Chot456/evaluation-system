<?php

namespace App\Http\Controllers;

use App\Models\questionaireCategory;
use Illuminate\Http\Request;

class QuestionaireCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return questionaireCategory::all();
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
            'questionCategoryDesc'=>'required',
        ]);
        $questionCategory = new questionaireCategory([
            'questionCategoryDesc' => $request->get('questionCategoryDesc'),
        ]);

        $questionCategory->save();

        return response()->json($questionCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\questionaireCategory  $questionaireCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return questionaireCategory::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\questionaireCategory  $questionaireCategory
     * @return \Illuminate\Http\Response
         */
    public function edit(questionaireCategory $questionaireCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\questionaireCategory  $questionaireCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, questionaireCategory $questionaireCategory)
    {
        $questionCategory = questionaireCategory::findOrFail($id);
        $questionCategory->questionCategoryDesc = $request->questionCategoryDesc;

        if($questionCategory->save()) {
            return response()->json($questionCategory, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\questionaireCategory  $questionaireCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(questionaireCategory $questionaireCategory)
    {
        $questionCategory = questionaireCategory::findOrFail($id);
        
        if ($questionCategory->delete()) {
            return response()->json("one record has been deleted!", 204);
        }
    }
}
