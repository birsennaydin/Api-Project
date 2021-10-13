<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Device extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    protected $table = "devices";
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    public function device_info($client_token){
        return Device::where("client_token",$client_token )->first();
    }

    public function device($device_id){
        return Device::where("id",$device_id)->first();
    }

}
