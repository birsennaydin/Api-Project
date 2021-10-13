<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Routes;
use MongoDB\Driver\Monitoring\Subscriber;
use App\Traits\IosApi;
use App\Traits\GoogleApi;
use App\Models\Device;
use App\Models\Subscription;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use DB;


class ApiPurchaseController extends Controller
{
    use IosApi,GoogleApi;

    protected $api_cert_data = null;
    protected $result = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchase(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'client_token' => 'required|string|max:80|min:60',
            'receipt' => 'required|string|max:64|min:60'
        ]);

        if ($validated->fails())
        {
            return response(['result' => 'failed', 'message' => $validated->errors()->all()],422);
        }
        $validated = $validated->validated();
       
      //  return response(['result' => $t]);
        $device_check =  Device::where(['client_token' => $validated["client_token"]])->first();

        if(!$device_check){
            return response(['result' => 'failed', 'message' => 'Client token can not be found.']);
        }else{

            if($device_check["os"] == "ios"){

                $auth_result = $this->iosAuthentication($validated["receipt"]);
            }else{
                $auth_result = $this->googleAuthentication($validated["receipt"]);
            }

            $subscription = Subscription::where(["device_id" => $device_check->id])->first();
            if($subscription){
                Subscription::where([
                    'device_id' => $device_check->id
                ])->update(['status'=> $auth_result->status, 'receipt' => $validated["receipt"],'expire'=>$auth_result->expire]);

            }else{

                Subscription::create([
                    'device_id'        => $device_check->id,
                    'status'          => $auth_result->status,
                    'expire'          => $auth_result->expire,
                    'receipt'         => $validated["receipt"],
                ]);
            }
            return response(['result' => $auth_result]);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
