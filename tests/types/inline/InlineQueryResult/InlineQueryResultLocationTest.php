<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultLocation;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultLocationTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultLocation::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultLocation::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('location', $a::TYPE);
    }
}