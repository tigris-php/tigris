<?php

use Tigris\Telegram\Types\Arrays\ChatMemberArray;
use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\ChatMember;
use Tigris\Telegram\Types\User;

class ChatMemberArrayTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = ChatMemberArray::parse([
            [
                'user' => [
                    'id'  => 100,
                    'first_name' => 'Tigris',
                    'last_name' => 'Bot',
                    'username' => '@tigrisbot',
                ],
                'status' => 'status',
            ],
            [
                'user' => [
                    'id'  => 100,
                    'first_name' => 'Tigris',
                    'last_name' => 'Bot',
                    'username' => '@tigrisbot',
                ],
                'status' => 'status',
            ]
        ]);

        $this->assertInstanceOf(ChatMemberArray::class, $a);
        $this->assertInstanceOf(BaseArray::class, $a);

        $this->assertInstanceOf(ChatMember::class, $a[0]);
        $this->assertInstanceOf(ChatMember::class, $a[1]);

        $this->assertInstanceOf(User::class, $a[0]->user);
        $this->assertInstanceOf(User::class, $a[1]->user);

        $b = ChatMemberArray::parse($a);
        $this->assertSame($a, $b);

        $z = ChatMember::parse(null);
        $this->assertNull($z);

    }
}