<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedDocument;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultCachedDocumentTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultCachedDocument::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedDocument::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('document', $a::TYPE);
    }
}