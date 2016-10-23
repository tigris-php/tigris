<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultVenue;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultVenueTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultVenue::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultVenue::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('venue', $a::TYPE);
    }
}