<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $name1 = config("contoh.name.first");
        $name2 = Config::get("contoh.name.first");

        self::assertSame($name1, $name2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make("config");
        $name3 = $config->get("contoh.name.first");

        $name1 = config("contoh.name.first");
        $name2 = Config::get("contoh.name.first");

        self::assertSame($name1, $name2);
        self::assertSame($name2, $name3);
    }

    public function testFacadeMock()
    {
        Config::shouldReceive("get")
            ->with("contoh.name.first")
            ->andReturn('Dono Kasino Indro');

        $name = Config::get("contoh.name.first");

        self::assertSame("Dono Kasino Indro", $name);
    }
}
