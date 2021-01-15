<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return course::all();
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
            'courseDescription'=>'required',
            'courseAcronym'=>'required'
        ]);
        $course = new course([
            'courseDescription' => $request->get('courseDescription'),
            'courseAcronym' => $request->get('courseAcronym')
        ]);
        $course->save();

        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        return course::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $course = course::findOrFail($id);
        $course->courseDescription = $request->courseDescription;
        $course->courseAcronym = $request->courseAcronym;

        if($course->save()) {
            return response()->json($course, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = course::findOrFail($id);

        if ($course->delete()) {
            return response()->json("one record has been deleted!", 204);
        }
    }
}
