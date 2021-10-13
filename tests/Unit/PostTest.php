<?php

namespace Tests\Unit;

use App\Model\Device;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
   // public function test_example()
    //{
      //  $this->assertTrue(true);
   // }

    public function ios_exampleee($receipt)
    {
        $data = [
            'receipt' => $receipt,
            'username' => "admin"
        ];
      //  return "123456";

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

}
