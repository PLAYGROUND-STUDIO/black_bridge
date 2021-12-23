<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */

namespace PlaygroundStudio\BlackBridge\Loaders;

use Jenssegers\Blade\Blade;

class BladeObjectLoader extends Loader
{
    /**
     * @param string $databaseName
     * @return Blade
     */
    public static function load(): Blade
    {
        return new Blade(__DIR__ . '/../../resources/views', __DIR__ . '/../../cache/views');
    }

}
