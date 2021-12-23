<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */

namespace PlaygroundStudio\BlackBridge;

use PlaygroundStudio\BlackBridge\Loaders\BladeObjectLoader;

class Element
{
    protected static function markMethodIsDeprecated($methodName)
    {
        trigger_error('Method ' . $methodName . ' is deprecated', E_USER_DEPRECATED);
    }

    protected function view($view, $data = []) {
        $blade = BladeObjectLoader::load();
        return $blade->render($view, $data);
    }
}
