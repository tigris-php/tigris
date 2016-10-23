<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedVoice;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultCachedVoiceTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultCachedVoice::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedVoice::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('voice', $a::TYPE);
    }
}