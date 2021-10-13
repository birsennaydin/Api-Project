<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "subscriptions";
    public function device()
    {
        return $this->belongsToMany(Device::class);
    }
    public function subscription_info($device_id){
        //return $device_id;
        return Subscription::where("device_id",$device_id)->first();
    }

    public function subscription_check(){
        return Subscription::where('expire', '<', date("Y-m-d H:i:s"))
            ->where('status', '=', 1)->get();
    }
}
