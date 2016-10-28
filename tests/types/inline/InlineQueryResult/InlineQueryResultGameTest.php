<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultGame;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultGameTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultGame::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultGame::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('game', $a::TYPE);
    }
}