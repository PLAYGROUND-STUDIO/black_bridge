<?php
/** @noinspection PhpUnused */
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */

namespace PlaygroundStudio\BlackBridge\Routers;

use PlaygroundStudio\BlackBridge\Element;
use PlaygroundStudio\BlackBridge\Loaders\BladeObjectLoader;

class Redirect extends Element
{
    /**
     * @deprecated This method is deprecated. We will remove it in later versions.
     */
    public static function postHtml($url, $params): string
    {
        Redirect::markMethodIsDeprecated(__METHOD__);

        $blade = BladeObjectLoader::load();
        $data = [
            'url' => $url,
            'params' => $params
        ];
        return $blade->render('post_redirect_html', $data);
    }

    public static function byPostMethodViaHtmlForm($url, $params): string
    {
        $blade = BladeObjectLoader::load();
        $data = [
            'url' => $url,
            'params' => $params
        ];
        return $blade->render('post_redirect_html', $data);
    }

    public static function byGetMethodViaPhpHeaderLocation($url)
    {
        header( "location: " . $url );
        exit(0);
    }

    public static function byGetMethodViaPhpHeaderRefresh($url, $time)
    {
        header( 'refresh: 2; url=' . $url );
        exit(0);
    }
}