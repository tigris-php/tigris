<?php

use Tigris\Types\Arrays\MessageEntityArray;
use Tigris\Types\MessageEntity;
use Tigris\Types\Base\BaseArray;
use Tigris\Types\User;
class MessageEntityArrayTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = MessageEntityArray::parse([
            [
                'type' => 'code',
                'offset' => 10,
                'length' => 15,
                'url' => 'url',
                'user' => [
                    'id'  => 100,
                    'first_name' => 'Tigris',
                    'last_name' => 'Bot',
                    'username' => '@tigrisbot',
                ],
            ],
            [
                'type' => 'code',
                'offset' => 10,
                'length' => 15,
                'url' => 'url',
                'user' => [
                    'id'  => 100,
                    'first_name' => 'Tigris',
                    'last_name' => 'Bot',
                    'username' => '@tigrisbot',
                ],
            ],
        ]);




        $this->assertInstanceOf(MessageEntityArray::class, $a);
        $this->assertInstanceOf(BaseArray::class, $a);

        $this->assertInstanceOf(MessageEntity::class, $a[0]);
        $this->assertInstanceOf(MessageEntity::class, $a[1]);

        $this->assertInstanceOf(User::class, $a[0]->user);
        $this->assertInstanceOf(User::class, $a[1]->user);

        $b = MessageEntityArray::parse($a);
        $this->assertSame($a, $b);

        $z = MessageEntity::parse(null);
        $this->assertNull($z);
    }
}