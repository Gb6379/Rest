<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $mockConsoleOutput = false;

    /** Return an user with test state
    
     */
    protected function test($overrides = [])
    {
        return factory(User::class)->states('testunit')->create($overrides);
    }


    /**
     * return an user
     */

    protected function user($overrides = [])
    {
        return factory(User::class)->create($overrides);
    }


    protected function actAsUser()
    {
        $this->actingAs($this->user());

        return $this;
    }
}
