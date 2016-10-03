<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\MessageEntity;
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\User;

class MessageEntityTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = MessageEntity::build([
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

        $b = MessageEntity::build($a);
        $this->assertSame($a, $b);

        $z = MessageEntity::build(null);
        $this->assertNull($z);

        try {
            MessageEntity::build('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            MessageEntity::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
