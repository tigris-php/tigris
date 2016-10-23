<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultGif;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultGifTestTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultGif::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultGif::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('gif', $a::TYPE);
    }
}