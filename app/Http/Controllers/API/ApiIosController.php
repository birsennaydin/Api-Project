<?php

namespace App\Http\Controllers\API;
;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Subscription;

class ApiIosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start_time = date("Y-m-d H:i:s");
        $end_time = date('Y-m-d H:i:s', strtotime('+10 minutes', strtotime($start_time)));

        if (substr($request["receipt"], -1) % 2 != 0) {
            return response(['result' => 'success', 'message' => 'Authentication is successfuly.', 'status' => true, 'expire' => $end_time]);
        } else {
            return response(['result' => 'fail', 'message' => 'Authentication is failed.', 'status' => false, 'expire' => $end_time]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
