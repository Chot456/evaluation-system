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
            'section_code' => $request->get('section'),
            'subject_code' => $request->get('subject_code'),
            'studId' => $request->get('studId'),
            'profId' => $request->get('profId'),
            'semester' => $request->get('semester'),
            'year' => $request->get('year')
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
        return section::findOrFail($id)->employees;
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
        $section->subject_code = $request->subject_code;
        $section->studId = $request->studId;
        $section->profId = $request->profId;
        $section->semester = $request->semester;
        $section->year = $request->year;

        if($section->save()) {
            return response()->json($questionaire, 201);
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
