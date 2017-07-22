<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\InlineKeyboardButton;

class InlineKeyboardButtonTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = InlineKeyboardButton::create($text = 'foo', $url = 'bar');

        $this->assertInstanceOf(BaseObject::class, $a);
        $this->assertInstanceOf(InlineKeyboardButton::class, $a);

        $this->assertAttributeSame('foo', 'text', $a);
        $this->assertAttributeSame('bar', 'url', $a);

        $b = InlineKeyboardButton::parse($a);
        $this->assertSame($a, $b);

        $z = InlineKeyboardButton::parse(null);
        $this->assertNull($z);

        try {
            InlineKeyboardButton::create($text = 'foo', $url = 'bar', $callback_data = 'data');
            $this->fail(['Not Exception']);
        } catch (\Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }

    }


}