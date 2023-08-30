<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello()
    {
        $this->get('/hello/Ridwan')
            ->assertSeeText('Hello Ridwan');
    }

    public function testRequest()
    {
        $this->get('/request/Dono', [
            "Accept" => "plain/text"
        ])
            ->assertSeeText('request/Dono')
            ->assertSeeText('http://localhost/request/Dono')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }
}
