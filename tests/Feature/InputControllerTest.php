<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input?name=Dono')
            ->assertSeeText('Hello Dono');

        $this->post('/input', [
            'name' => 'Ridwan'
        ])
            ->assertSeeText('Hello Ridwan');
    }

    public function testNestedInput()
    {
        $this->post('/input/first', [
            'name' => [
                'first' => 'Ridwan'
            ]
        ])
            ->assertSeeText('Hello Ridwan');
    }

    public function testAllInput()
    {
        $this->post('/input/hello', [
            'name' => [
                'first' => 'Ridwan',
                'last' => 'Hidayat'
            ]
        ])
            ->assertSeeText('first')
            ->assertSeeText('Ridwan')
            ->assertSeeText('last')
            ->assertSeeText('Hidayat');
    }

    public function testArrayInput()
    {
        $this->post('/input/array', [
            'students' => [
                [
                    'first' => 'Ridwan',
                    'last' => 'Hidayat'
                ],
                [
                    'first' => 'Dono',
                    'last' => 'Kasino'
                ],
            ]
        ])
            ->assertSeeText('Ridwan')
            ->assertSeeText('Dono');
    }

    public function testTypeInput()
    {
        $this->post('/input/type', [
            'name' => 'Ridwan',
            'is_married' => true,
            'birth_date' => '1993-04-07'
        ])
            ->assertSeeText('true')
            ->assertSeeText('Ridwan')
            ->assertSeeText('1993-04-07');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Ridwan',
                'middle' => 'Nurul',
                'last' => 'Hidayat'
            ],
            'admin' => 'dono'
        ])
            ->assertSeeText('Ridwan')
            ->assertSeeText('Hidayat')
            ->assertDontSeeText('dono');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'name' => [
                'first' => 'Ridwan',
                'middle' => 'Nurul',
                'last' => 'Hidayat'
            ],
            'admin' => 'dono'
        ])
            ->assertSeeText('Ridwan')
            ->assertSeeText('Nurul')
            ->assertSeeText('Hidayat')
            ->assertDontSeeText('dono');
    }
}
