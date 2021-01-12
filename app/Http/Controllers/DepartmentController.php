<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return Auth::id();
         return department::all();
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
        // $department = department::create($request->all());

        $request->validate([
            'deptDescription'=>'required',
            'deptAcronym'=>'required'
        ]);
        $department = new department([
            'deptDescription' => $request->get('deptDescription'),
            'deptAcronym' => $request->get('deptAcronym'),
        ]);
        $department->save();

        return response()->json($department, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return department::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = department::findOrFail($id);
        $department->deptDescription = $request->deptDescription;
        $department->deptAcronym = $request->deptAcronym;

        if($department->save()) {
            return response()->json($department, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = department::findOrFail($id);

        if ($department->delete()) {
            return response()->json("one record has been deleted!", 204);
        }
    }
}
