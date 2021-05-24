<?php
namespace Tests\Loaders;

use Nahid\QArray\Exceptions\ConditionNotAllowedException;
use Nahid\QArray\Exceptions\InvalidNodeException;
use PlaygroundStudio\BlackBridge\Loaders\CellDataLoader;
use PHPUnit\Framework\TestCase;

class CellDataLoaderTest extends TestCase
{
    public function testLoad()
    {
        $data = CellDataLoader::load();
        $this->assertJson($data);
    }

    public function testLoadJson()
    {
        $data = CellDataLoader::loadJson();
        $this->assertJson($data);
    }

    public function testLoadArray()
    {
        $data = CellDataLoader::loadArray();
        $this->assertIsArray($data);
    }

    /**
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function testLoadJsonQuery()
    {
        $data = CellDataLoader::loadJsonQuery();
        $months = $data->from('months')->where('id', '=', '6')->first();
        $this->assertEquals("มิถุนายน", $months->name, 'B');
    }
}