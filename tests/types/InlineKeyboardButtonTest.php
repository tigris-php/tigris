<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */

use Tigris\Types\InlineKeyboardButton;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\CallbackGame;
class InlineKeyboardButtonTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = InlineKeyboardButton::create($text = 'foo', $url = 'bar');

        $this->assertInstanceOf(BaseObject::class, $a);
        $this->assertInstanceOf(InlineKeyboardButton::class, $a);

        $this->assertSame('foo', $a->text, $a);
        $this->assertSame('bar', $a->url, $a);

//        $b = InlineKeyboardButton::create($text = 'foo', $callback_data = 'bar');
//
//        $this->assertInstanceOf(BaseObject::class, $b);
//        $this->assertInstanceOf(InlineKeyboardButton::class, $b);
//
//        $this->assertSame('foo', $b->text, $b);
//        $this->assertSame('bar', $b->callback_data, $b);
//
//
//        $c = InlineKeyboardButton::create($text = 'foo', $switch_inline_query = 'bar');
//        $this->assertSame('foo', $c->text, $c);
//        $this->assertSame('bar', $c->switch_inline_query, $c);
//
//
//        $d = InlineKeyboardButton::create($text = 'foo', $switch_inline_query_current_chat = 'bar');
//        $this->assertSame('foo', $d->text, $d);
//        $this->assertSame('bar', $d->switch_inline_query_current_chat, $d);




        try {
            InlineKeyboardButton::create($text = 'foo', $url = 'bar', $callback_data = 'data');
            $this->fail(['Not Exception']);
        } catch (\Exception $e) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
        }

    }


}