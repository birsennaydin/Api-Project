<?php

namespace App\Traits;

use App\Models\Device;
use App\Models\Subscription;
use App\Traits\IosApi;
use App\Traits\GoogleApi;
use DB;

use Illuminate\Support\Facades\Http;

trait SubscriptionWorker
{
    use IosApi, GoogleApi;
    private $subscription_check = null;
    private $auth_result = null;
    private $subscription_obj;
    private $device_obj;

    /**
     * Worker constructor.
     */
    public function __construct()
    {
        $this->subscription_obj = new Subscription();
        $this->device_obj = new Device();
    }


    public function subscriptionUpdate()
    {
        //Get the data(expire < Now() and status = true)
        $this->subscription_checks = $this->subscription_obj->subscription_check();

        foreach ($this->subscription_checks as $subscription_check){
            $device_info = Device::find($subscription_check->id);
           // $device_info =  $this->device_obj->device($subscription_check->id);

            //Authentication with receipt value
            if($device_info["os"] == "ios"){

                $this->auth_result = $this->iosAuthentication($subscription_check["receipt"]);
            }else{
                $this->auth_result = $this->googleAuthentication($subscription_check["receipt"]);
            }

            //Update Subscription Table
            Subscription::where([
                'device_id' => $subscription_check->id
            ])->update(['status'=> $this->auth_result->status, 'receipt' => $subscription_check["receipt"],'expire'=>$this->auth_result->expire]);
        }
    }
}