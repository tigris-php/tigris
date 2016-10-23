<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedAudio;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultCachedAudioTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = InlineQueryResultCachedAudio::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultCachedAudio::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('audio', $a::TYPE);
    }
}