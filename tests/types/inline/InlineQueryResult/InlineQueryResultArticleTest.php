<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultArticle;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultArticleTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultArticle::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultArticle::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('article', $a::TYPE);
    }
}