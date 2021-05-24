<?php
/** @noinspection PhpUnused */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */

namespace PlaygroundStudio\BlackBridge\Routers;

use PlaygroundStudio\BlackBridge\Element;
use PlaygroundStudio\BlackBridge\Loaders\BladeObjectLoader;

class Redirect extends Element
{
    public static function postHtml($url, $params): string
    {
        $blade = BladeObjectLoader::load();
        $data = [
            'url' => $url,
            'params' => $params
        ];
        return $blade->render('post_redirect_html', $data);
    }
}