<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultAudio;
use Tigris\Types\Inline\InlineQueryResult;

class InlineQueryResultAudioTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQueryResultAudio::parse([]);
        $this->assertInstanceOf(\Tigris\Types\Inline\InlineQueryResult\InlineQueryResultAudio::class, $a);
        $this->assertInstanceOf(InlineQueryResult::class, $a);

        $this->assertSame('audio', $a::TYPE);
    }
}