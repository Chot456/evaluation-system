<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return section::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->validate([
            'section_code'=>'required',
        ]);

        $section = new section([
            'section_code' => $request->get('section_code'),
            'subjCode' => $request->get('subjCode'),
            'evaluator_id' => $request->get('evaluator_id'),
            'employee_id' => $request->get('employee_id'),
            'semesterDescription' => $request->get('semesterDescription'),
            'yearDescription' => $request->get('yearDescription')
        ]);

        $section->save();

        return response()->json($section, 201);
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
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return section::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $section = section::findOrFail($id);
        $section->section_code = $request->section_code;
        $section->subjCode = $request->subjCode;
        $section->evaluator_id = $request->evaluator_id;
        $section->employee_id = $request->employee_id;
        $section->semesterDescription = $request->semesterDescription;
        $section->yearDescription = $request->yearDescription;

        if($section->save()) {
            return response()->json($section, 201);
        }
    }

    /**
     * update publish only
     * 
     */
    public function updatePublish(Request $request, $id)
    {
        $section = section::findOrFail($id);
        $section->publish = $request->publish;

        if($section->save()) {
            return response()->json($section, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(section $section)
    {
        //
    }
}
