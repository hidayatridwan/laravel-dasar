<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/type/hello')
            ->assertSeeText('Hello Response')
            ->assertStatus(200);
    }

    public function testHeader()
    {
        $this->get('/response/type/header')
            ->assertSeeText('Ridwan')
            ->assertSeeText('Hidayat')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Ridwan Hidayat');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Ridwan Hidayat');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson(['name' => 'Ridwan Hidayat', 'age' => 30]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('ridwan.png');
    }
}
