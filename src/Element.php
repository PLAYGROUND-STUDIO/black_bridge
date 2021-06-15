<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */

namespace PlaygroundStudio\BlackBridge;

class Element
{
    protected static function markMethodIsDeprecated($methodName)
    {
        trigger_error('Method ' . $methodName . ' is deprecated', E_USER_DEPRECATED);
    }
}