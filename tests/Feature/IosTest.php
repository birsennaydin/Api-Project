<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class IosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function ios_example($receipt)
    {
        Http::fake();

        $response = $this->get('/');
        //$result = Http::post('/ios', [
          //  'name' => 'Taylor',
            //'role' => 'Developer',
        //]);
        return $response;
        //return $result->body();

        //$response = $this->withHeaders([
          //  'X-Header' => 'Value',
       // ])->post('/ios', ['result' => 'OK']);

        $response->assertStatus(201);
    }
}