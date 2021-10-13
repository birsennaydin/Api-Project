<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Device;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ApiSubscriptionController extends Controller
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
    public function subscription(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'client_token' => 'required|string|max:80|min:60'
        ]);


        if ($validated->fails()) {
            return response(['errors' => $validated->errors()->all()], 422);
        }
        $validated = $validated->validated();

        $device_obj = new Device();
        $subscription_obj = new Subscription();

        //Get the device info
        $device_info = $device_obj->device_info($validated["client_token"]);
        if (!$device_info) {
            return response(['result' => 'fail', 'message' => 'Authentication is failed.']);
        }
        //Get the Subscription info
        $subscription_infos = $subscription_obj->subscription_info($device_info->id);
        if (!$subscription_infos) {
            return response(['result' => 'fail', 'message' => 'Could not be find subscription.']);
        }
        $subscription_info["uid"] = $device_info->uid;
        $subscription_info["appId"] = $device_info->appId;
        $subscription_info["status"] = $subscription_infos->status;
        $subscription_info["Expire"] = $subscription_infos->expire;
        return response(['result' => 'success', 'message' => 'Subscription lists.', 'lists' => $subscription_info]);
    }

}
