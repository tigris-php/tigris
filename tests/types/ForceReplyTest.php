<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\ForceReply;

class ForceReplyTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ForceReply::create(true);
        $this->assertInstanceOf(ForceReply::class, $a);
        $this->assertSame(true, $a->force_reply->value, $a);
        $this->assertSame(true, $a->selective->value, $a);
    }
}