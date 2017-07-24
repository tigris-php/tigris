<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Types\Interfaces\ReplyMarkupInterface;
use Tigris\Telegram\Types\ReplyKeyboardHide;

class ReplyKeyboardHideTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ReplyKeyboardHide::create(true);
        $this->assertInstanceOf(ReplyMarkupInterface::class, $a);
        $this->assertInstanceOf(ReplyKeyboardHide::class, $a);
        $this->assertSame(true, $a->hide_keyboard, $a);
        $this->assertSame(true, $a->selective, $a);
    }
}