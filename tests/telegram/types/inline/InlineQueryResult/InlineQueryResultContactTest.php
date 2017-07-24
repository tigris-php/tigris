<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultContact;

class InlineQueryResultContactTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultContact::parse([]);
        $this->assertInstanceOf(\Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultContact::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('contact', $a::TYPE);
    }
}