<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\ForceReply;
use Tigris\Types\Interfaces\ReplyMarkupInterface;

class ForceReplyTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ForceReply::create(true);
        $this->assertInstanceOf(ReplyMarkupInterface::class, $a);
        $this->assertInstanceOf(ForceReply::class, $a);
        $this->assertSame(true, $a->force_reply, $a);
        $this->assertSame(true, $a->selective, $a);
    }
}