<?php

namespace App\Traits;

use App\DiscoveredCerts;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Http;
use App\DiscoveredServers;
use App\DiscoverPivots;
use DB;

trait IosApi
{
    /**
     * Step Zero
     * $accountInfo = ["api_user" => "test", "api_passwd" => "test%123", "api_url" => "https://......."]
     *
     */
    public function iosAuthentication($receipt)
    {
        //$url = "http://127.0.0.1:8080/api/ios/";
        $url = "https://localhost/api/ios/";
        $api_user = "ios";
        $api_passwd = "123456";
        try {
            //If you want to use basic auth you can use below code
           // $response = Http::withOptions([
             //   'debug' => true,
               // 'verify' => false,
            //])->withBasicAuth($api_user, $api_passwd)->get('http://127.0.0.1/api/ios', [
            //])->throw();

            $response = Http::post('http://127.0.0.1/api/ios', [
                'receipt' => $receipt,
                'username' => $api_user,
                'passwd' => $api_passwd
            ]);
           // return $response->body();
            if ($response->successful() != false) {

               return json_decode($response->body());


            } else {
                return $result = array(
                    "result" => false
                );
            }
        } catch (\Exception $e) {

            return $result = array(
                "result" => false,
            );


        }

    }


}
