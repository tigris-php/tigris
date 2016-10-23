<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultMpeg4Gif;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultMpeg4GifTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultMpeg4Gif::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultMpeg4Gif::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('mpeg4_gif', $a::TYPE);
    }
}