<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultMpeg4Gif;

class InlineQueryResultMpeg4GifTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultMpeg4Gif::parse([]);
        $this->assertInstanceOf(\Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultMpeg4Gif::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('mpeg4_gif', $a::TYPE);
    }
}