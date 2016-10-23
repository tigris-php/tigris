<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedPhoto;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultCachedPhotoTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultCachedPhoto::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedPhoto::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('photo', $a::TYPE);
    }
}