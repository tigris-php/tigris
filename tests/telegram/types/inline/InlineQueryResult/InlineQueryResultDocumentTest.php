<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultDocument;

class InlineQueryResultDocumentTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultDocument::parse([]);
        $this->assertInstanceOf(\Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultDocument::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('document', $a::TYPE);
    }
}