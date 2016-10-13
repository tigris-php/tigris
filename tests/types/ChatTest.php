<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Chat;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

class ChatTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Chat::parse([
            'id' => 123,
            'type' => 'channel',
            'title' => 'Some Channel',
            'username' => '@tigrisbot',
            'first_name' => 'Tigris',
            'last_name' => 'Bot',
        ]);

        $this->assertInstanceOf(Chat::class, $a);
        $this->assertAttributeSame(123, 'id', $a);
        $this->assertAttributeSame('channel', 'type', $a);
        $this->assertAttributeSame('Some Channel', 'title', $a);
        $this->assertAttributeSame('@tigrisbot', 'username', $a);
        $this->assertAttributeSame('Tigris', 'first_name', $a);
        $this->assertAttributeSame('Bot', 'last_name', $a);

        $b = Chat::parse($a);
        $this->assertSame($a, $b);

        $z = Chat::parse(null);
        $this->assertNull($z);

        try {
            Chat::parse('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Chat::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }

    public function testToString()
    {
        $a = Chat::parse([
            'id' => 100500,
            'type' => 'channel',
            'title' => 'Some Channel',
            'username' => '@tigrisbot',
            'first_name' => 'Tigris',
            'last_name' => 'Bot',
        ]);

        $this->assertSame('100500', (string) $a);
    }
}
