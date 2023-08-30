<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText('Create Cookie')
            ->assertCookie('username', 'ridwan')
            ->assertCookie('isMember', true);
    }

    public function testGetCookie()
    {
        $this->withCookie('username', 'ridwan')
            ->withCookie('isMember', true)
            ->get('/cookie/get')
            ->assertJson([
                'username' => 'ridwan',
                'isMember' => true
            ]);
    }
}
