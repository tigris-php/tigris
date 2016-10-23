<?php

/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\CallbackQuery;
use Tigris\Types\User;

class CallbackQueryTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = CallbackQuery::parse([
            'id' => '123',
            'from' => [
                'id' => 1147,
                'first_name' => 'Tigris',
                'last_name' => 'Bot',
                'username' => '@tigrisbot',
            ],
            'chat_instance' => 'foo',
            'game_short_name' => 'bar',
        ]);

        $this->assertInstanceOf(CallbackQuery::class, $a);
        $this->assertAttributeInstanceOf(User::class, 'from', $a);
        $this->assertAttributeSame('123', 'id', $a);
        $this->assertAttributeSame('foo', 'chat_instance', $a);
        $this->assertAttributeSame('bar', 'game_short_name', $a);

        $b = CallbackQuery::parse($a);
        $this->assertSame($b, $a);

        $z = CallbackQuery::parse(null);
        $this->assertNull($z);


        try {
            CallbackQuery::parse('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            CallbackQuery::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }

    public function testToString()
    {
        $a = CallbackQuery::parse([
            'id' => 123,
            'chat_instance' => 'foo',
            'game_short_name' => 'bar',
        ]);

        $this->assertSame('123', (string) $a);
    }
}