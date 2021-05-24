<?php
namespace Tests\Routers;

use Exception;
use Nahid\QArray\Exceptions\ConditionNotAllowedException;
use Nahid\QArray\Exceptions\InvalidNodeException;
use PlaygroundStudio\BlackBridge\Loaders\CellDataLoader;
use PHPUnit\Framework\TestCase;
use PlaygroundStudio\BlackBridge\Routers\Redirect;

class RedirectTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testPostHtml()
    {
        $random0 = random_int(100, 999);
        $random1 = random_int(100, 999);
        $random2 = random_int(100, 999);
        $url = 'http://localhost/test/' . $random0;
        $html = Redirect::postHtml($url, [
            'random1' => $random1,
            'random2' => $random2
        ]);

        $needle = '<form action="' . $url;
        $this->assertStringContainsString($needle, $html, "A");

        $needle = '<input type="hidden" name="random1" value="' . $random1;
        $this->assertStringContainsString($needle, $html, "B");

        $needle = '<input type="hidden" name="random2" value="' . $random2;
        $this->assertStringContainsString($needle, $html, "B");
    }
}