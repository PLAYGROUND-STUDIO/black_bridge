<?php
/** @noinspection PhpRedundantOptionalArgumentInspection */
/** @noinspection PhpIllegalPsrClassPathInspection */
/** @noinspection PhpParamsInspection */

use Nahid\QArray\Exceptions\ConditionNotAllowedException;
use Nahid\QArray\Exceptions\InvalidNodeException;
use PlaygroundStudio\BlackBridge\Loaders\CellDataLoader;
use PHPUnit\Framework\TestCase;

class CellDataLoaderTest extends TestCase
{
    public function testLoad()
    {
        $data = CellDataLoader::load('common');
        $this->assertJson($data);
    }

    public function testLoadJson()
    {
        $data = CellDataLoader::loadJson('common');
        $this->assertJson($data);
    }

    public function testLoadArray()
    {
        $data = CellDataLoader::loadArray('common');
        $this->assertIsArray($data);
    }

    /**
     * @throws ConditionNotAllowedException
     * @throws InvalidNodeException
     */
    public function testLoadJsonQuery()
    {
        $data = CellDataLoader::loadJsonQuery('common');
        $months = $data->from('months')->where('id', '=', '6')->first();
        $this->assertEquals("มิถุนายน", $months->name, 'B');
    }
}