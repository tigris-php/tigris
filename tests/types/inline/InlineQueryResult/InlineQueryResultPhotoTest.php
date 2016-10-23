<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultPhoto;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultPhotoTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultPhoto::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultPhoto::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('photo', $a::TYPE);
    }
}