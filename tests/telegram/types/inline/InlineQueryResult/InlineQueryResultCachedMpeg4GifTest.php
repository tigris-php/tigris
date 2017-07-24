<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultCachedMpeg4Gif;

class InlineQueryResultCachedMpeg4GifTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultCachedMpeg4Gif::parse([]);
        $this->assertInstanceOf(\Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultCachedMpeg4Gif::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('mpeg4_gif', $a::TYPE);
    }
}