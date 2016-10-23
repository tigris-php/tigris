<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedVideo;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultCachedVideoTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultCachedVideo::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedVideo::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('video', $a::TYPE);
    }
}