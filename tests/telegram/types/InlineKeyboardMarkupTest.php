<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\InlineKeyboardButton;
use Tigris\Telegram\Types\InlineKeyboardMarkup;
use Tigris\Telegram\Types\Interfaces\ReplyMarkupInterface;

class InlineKeyboardMarkupTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = InlineKeyboardMarkup::create($inline_keyboard = [InlineKeyboardButton::create('text')]);

        $this->assertInstanceOf(ReplyMarkupInterface::class, $a);

    }
}