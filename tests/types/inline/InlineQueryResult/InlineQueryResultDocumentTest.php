<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultDocument;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultDocumentTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultDocument::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultDocument::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('document', $a::TYPE);
    }
}