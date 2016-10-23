<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedSticker;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultCachedStickerTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultCachedSticker::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedSticker::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('sticker', $a::TYPE);
    }
}