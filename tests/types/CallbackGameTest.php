<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\CallbackGame;
class CallbackGameTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = CallbackGame::parse([1,2,3]);
        $this->assertInstanceOf(CallbackGame::class, $a);

        $b = CallbackGame::parse($a);
        $this->assertSame($a, $b);

        $z = CallbackGame::parse(null);
        $this->assertNull($z);

    }
}