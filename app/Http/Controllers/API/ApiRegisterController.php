<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class ApiRegisterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }


    /**
     * Register a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'uid' => 'required|string|max:255',
            'appId' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'os' => 'required|string|max:50|min:3'
        ]);


        if ($validated->fails()) {
            return response(['errors' => $validated->errors()->all()], 422);
        }
        $validated = $validated->validated();


        $device_check = Device::where(['uid' => $validated["uid"], 'appId' => $validated["appId"]])->first();

        if (!$device_check) {

            //add expire time(+5 minutes)
            $start_time = date("Y-m-d H:i:s");
            $end_time = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($start_time)));

            //Create Client Token
            $client_token = Str::random(60);
            //New uid Register
            Device::create([
                'uid' => $validated["uid"],
                'appId' => $validated["appId"],
                'language' => $validated["language"],
                'os' => $validated["os"],
                'client_token' => $client_token,
                'expire' => $end_time
            ]);
            return response(['result' => 'success', 'message' => 'Register prosess is success.', 'client_token' => $client_token]);
        } else {
            //Uid aldready register
            return response(['result' => "success", 'message' => 'Device already register.', 'client_token' => $device_check["client_token"]]);
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
