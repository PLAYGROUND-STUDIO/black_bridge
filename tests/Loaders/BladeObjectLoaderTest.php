<?php
namespace Tests\Loaders;

use Jenssegers\Blade\Blade;
use PlaygroundStudio\BlackBridge\Loaders\BladeObjectLoader;
use PHPUnit\Framework\TestCase;

class BladeObjectLoaderTest extends TestCase
{
    public function testLoad()
    {
        $data = BladeObjectLoader::load();
        $this->assertIsObject($data);
    }
}