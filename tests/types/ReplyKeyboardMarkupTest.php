<?php

use Tigris\Types\ReplyKeyboardMarkup;
use Tigris\Types\KeyboardButton;
use Tigris\Types\Interfaces\ReplyMarkupInterface;
use Tigris\Exceptions\TelegramTypeException;
Class ReplyKeyboardMarkupTest extends  PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = ReplyKeyboardMarkup::create([
                'keyboard' => [
                    'text' => 'foo'
                ]
        ]);

        $this->assertInstanceOf(ReplyKeyboardMarkup::class, $a);
        $this->assertInstanceOf(ReplyMarkupInterface::class, $a);

        $b = ReplyKeyboardMarkup::parse($a);
        $this->assertSame($a, $b);

        $z = ReplyKeyboardMarkup::parse(null);
        $this->assertNull($z);

        try {
            ReplyKeyboardMarkup::parse([]);
            $this->fail(['Not exception']);
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }



    }
}