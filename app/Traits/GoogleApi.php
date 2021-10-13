<?php

namespace App\Traits;

use App\DiscoveredCerts;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Http;
use App\DiscoveredServers;
use App\DiscoverPivots;
use DB;

trait GoogleApi
{
    /**
     * Step Zero
     * $accountInfo = ["api_user" => "test", "api_passwd" => "test%123", "api_url" => "https://......."]
     *
     */
    public function googleAuthentication($receipt)
    {
        $url = "http://127.0.0.1/api/google";
        $api_user = "admin";
        $api_passwd = "admin";

        try {

            $response = Http::post($url, [
                'receipt' => $receipt,
                'username' => $api_user,
                'passwd' => $api_passwd
            ]);
           // return $response;
            //dd($response);
            if ($response->successful() != false) {

                return json_decode($response->body());

            } else {
                return array(
                    "result" => false
                );
            }
        } catch (\Exception $e) {

            return array(
                "result" => false,
            );


        }

    }


}
