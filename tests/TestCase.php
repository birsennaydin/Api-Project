<?php

namespace Tests;

use Feature\IosTest;
use Unit\PostTest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected $test;
    public function setUp(): void
    {
        parent::setUp();
        $this->test = Factory::create();
    }
}
