<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilesystemManagerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRefactory()
    {
        $filesystem = new FilesystemManager( app());
        $this->assertInstanceOf(\Illuminate\Filesystem\FilesystemAdapter::class, $filesystem->drive('local'));
        $this->assertInstanceOf(\Illuminate\Filesystem\FilesystemAdapter::class, $filesystem->disk('public'));
        $this->assertInstanceOf(\League\Flysystem\Config::class, $filesystem->getConfig('s3'));
    }
}
