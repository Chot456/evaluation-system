<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return subject::all();
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
            'subjCode'=>'required',
            'subjDesc'=>'required'
        ]);

        $subject = new subject([
            'subjCode' => $request->get('subjCode'),
            'subjDesc' => $request->get('subjDesc'),
            'semesterId' => $request->get('semesterId'),
            'unit' => $request->get('unit')
        ]);

        $subject->save();

        return response()->json($subject, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return subject::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject = subject::findOrFail($id);
        
        $subject->subjCode = $request->subjCode;
        $subject->subjDesc = $request->subjDesc;
        $subject->semesterId = $request->semesterId;
        $subject->unit = $request->unit;

        if($subject->save()) {
            return response()->json($subject, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(subject $subject)
    {
        //
    }
}
