<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\ReplyKeyboardHide;
use Tigris\Types\Interfaces\ReplyMarkupInterface;

class ReplyKeyboardHideTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ReplyKeyboardHide::create(true);
        $this->assertInstanceOf(ReplyMarkupInterface::class, $a);
        $this->assertInstanceOf(ReplyKeyboardHide::class, $a);
        $this->assertSame(true, $a->hide_keyboard->value, $a);
        $this->assertSame(true, $a->selective->value, $a);
    }
}