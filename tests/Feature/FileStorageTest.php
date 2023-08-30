<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $fs = Storage::disk('local');
        $fs->put('file.txt', 'Ridwan Nurul Hidayat');

        $content = $fs->get('file.txt');

        self::assertEquals('Ridwan Nurul Hidayat', $content);
    }

    public function testPublic()
    {
        $fs = Storage::disk('public');
        $fs->put('file.txt', 'Ridwan Nurul Hidayat');

        $content = $fs->get('file.txt');

        self::assertEquals('Ridwan Nurul Hidayat', $content);
    }
}
