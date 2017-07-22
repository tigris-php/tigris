<?php

use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Chat;
use Tigris\Types\Message;

class MessageTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = Message::parse([
            'message_id' => 112,
            'date' => 17454565,
            'chat' => [
                'id' => 10,
                'type' => 'type',
                'title' => 'title',
                'username' => '@tigrisbot',
                'first_name' => 'Tigris',
                'last_name' => 'Bot',
                'all_members_are_administrators' => false,
            ]
        ]);

        $this->assertInstanceOf(Message::class, $a);
        $this->assertInstanceOf(BaseObject::class, $a);

        $this->assertAttributeSame(112, 'message_id', $a);
        $this->assertAttributeSame(17454565, 'date', $a);

        $this->assertAttributeInstanceOf(Chat::class, 'chat', $a);


        $z = Message::parse(null);
        $this->assertNull($z);


        try {
            Message::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }

    public function testToString()
    {
        $a = Message::parse([
            'message_id' => 1299,
        ]);

        $this->assertSame('1299', (string)$a);
    }


}