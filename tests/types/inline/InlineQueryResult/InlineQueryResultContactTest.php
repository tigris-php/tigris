<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultContact;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultContactTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultContact::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultContact::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('contact', $a::TYPE);
    }
}