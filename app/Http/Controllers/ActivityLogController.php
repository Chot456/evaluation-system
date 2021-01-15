<?php

namespace App\Http\Controllers;

use App\Models\activity_log;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return activity_log::all();
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
        // $request->ip(), Request::ip(), request()->ip(), $this->getIp()
        $request->validate([
            'logs'=>'required',
            'username'=>'required'
        ]);

        $aRes = new activity_log([
            'logs' => $request->get('logs'),
            'username' => $request->get('username'),
        ]);

        $aRes->save();

        return response()->json($aRes, 201);
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\activity_log  $activity_log
     * @return \Illuminate\Http\Response
     */
    public function show(activity_log $activity_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\activity_log  $activity_log
     * @return \Illuminate\Http\Response
     */
    public function edit(activity_log $activity_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\activity_log  $activity_log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, activity_log $activity_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\activity_log  $activity_log
     * @return \Illuminate\Http\Response
     */
    public function destroy(activity_log $activity_log)
    {
        //
    }
}
