<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\ChatPhoto;

class ChatPhotoTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = ChatPhoto::parse([
            'small_file_id' => '123',
            'big_file_id' => '456',
        ]);

        $this->assertInstanceOf(ChatPhoto::class, $a);
        $this->assertAttributeSame('123', 'small_file_id', $a);
        $this->assertAttributeSame('456', 'big_file_id', $a);

        $b = ChatPhoto::parse($a);
        $this->assertSame($a, $b);

        $z = ChatPhoto::parse(null);
        $this->assertNull($z);

        try {
            ChatPhoto::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            ChatPhoto::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
