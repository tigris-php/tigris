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
            'offset' => '0',
            'length' => '100',
            'url' => 'https://telegram.me',
            'user' => [
                'id' => 100500,
                'first_name' => 'Tigris',
                'last_name' => 'Bot',
                'username' => '@tigrisbot',
            ],
        ]);

        $this->assertInstanceOf(MessageEntity::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'type', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'offset', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'length', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'url', $a);
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
