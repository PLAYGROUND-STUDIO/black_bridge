<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */

namespace PlaygroundStudio\BlackBridge\Loaders;

use Nahid\JsonQ\Jsonq;

class CellDataLoader extends Loader
{
    /**
     * @param string $databaseName
     * @return string
     */
    public static function load(string $databaseName = 'common'): string
    {
        $uri = sprintf("/../../data/%s.json", $databaseName);
        return file_get_contents(__DIR__ . $uri);
    }

    /**
     * @param string $databaseName
     * @return string
     */
    public static function loadJson(string $databaseName = 'common'): string
    {
        return CellDataLoader::load($databaseName);
    }

    /**
     * @param string $databaseName
     * @return array
     */
    public static function loadArray(string $databaseName = 'common'): array
    {
        $json = CellDataLoader::load($databaseName);
        return (array) json_decode($json);
    }

    /**
     * @param string $databaseName
     * @return Jsonq
     */
    public static function loadJsonQuery(string $databaseName = 'common'): Jsonq
    {
        $json = CellDataLoader::load($databaseName);
        return new Jsonq($json);
    }
}