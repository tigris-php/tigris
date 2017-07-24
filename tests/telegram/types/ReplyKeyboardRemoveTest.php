<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Types\Interfaces\ReplyMarkupInterface;
use Tigris\Telegram\Types\ReplyKeyboardRemove;

class ReplyKeyboardRemoveTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ReplyKeyboardRemove::create(true);
        $this->assertInstanceOf(ReplyMarkupInterface::class, $a);
        $this->assertInstanceOf(ReplyKeyboardRemove::class, $a);
        $this->assertSame(true, $a->remove_keyboard, $a);
        $this->assertSame(true, $a->selective, $a);
    }
}