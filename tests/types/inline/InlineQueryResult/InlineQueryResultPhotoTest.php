<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultPhoto;

class InlineQueryResultPhotoTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultPhoto::parse([]);
        $this->assertInstanceOf(\Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultPhoto::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('photo', $a::TYPE);
    }
}