<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultCachedVoice;

class InlineQueryResultCachedVoiceTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultCachedVoice::parse([]);
        $this->assertInstanceOf(\Tigris\Telegram\Types\Inline\InlineQueryResult\InlineQueryResultCachedVoice::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('voice', $a::TYPE);
    }
}