<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testMiddlewareInvalid()
    {
        $this->get('/middleware/api')
            ->assertSeeText('Access denied')
            ->assertStatus(401);
    }

    public function testMiddlewareValid()
    {
        $this->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/api')
            ->assertSeeText('OK')
            ->assertStatus(200);
    }

    public function testMiddlewareGroupInvalid()
    {
        $this->get('/middleware/group')
            ->assertSeeText('Access denied')
            ->assertStatus(401);
    }

    public function testMiddlewareGroupValid()
    {
        $this->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/group')
            ->assertSeeText('GROUP')
            ->assertStatus(200);
    }
}
