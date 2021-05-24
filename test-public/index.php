<?php
require_once '../vendor/autoload.php';

echo \PlaygroundStudio\BlackBridge\Routers\Redirect::postHtml('http://localhost/test/post_except_csrf', [
    'a1' => 'aaa'
]);