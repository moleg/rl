<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->visit("/")
            ->type("Anton","first_name")
            ->type("Paschenko","last_name")
            ->type("Харьков","city")
            ->type("Школа N1","school")
            ->type("Юрий Орленыч","teacher")
            ->type("anpachenko@gmail.com","email")
            ->type("0956298946","phone")
            ->press("registration")
            ->seePageIs("/");


    }
}
