<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Types\MessageEntity;
use Tigris\Types\User;

class MessageEntityTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = MessageEntity::parse([
            'type' => 'text_mention',
            'offset' => 123,
            'length' => 456,
            'url' => 'https://telegram.me',
            'user' => [
                'id' => 100500,
                'first_name' => 'Tigris',
                'last_name' => 'Bot',
                'username' => '@tigrisbot',
            ],
        ]);

        $this->assertInstanceOf(MessageEntity::class, $a);
        $this->assertAttributeSame('text_mention', 'type', $a);
        $this->assertAttributeSame(123, 'offset', $a);
        $this->assertAttributeSame(456, 'length', $a);
        $this->assertAttributeSame('https://telegram.me', 'url', $a);
        $this->assertAttributeInstanceOf(User::class, 'user', $a);

        $b = MessageEntity::parse($a);
        $this->assertSame($a, $b);

        $z = MessageEntity::parse(null);
        $this->assertNull($z);

        try {
            MessageEntity::parse('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            MessageEntity::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
