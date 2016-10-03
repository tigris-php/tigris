<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\KeyboardButton;

class KeyboardButtonTest extends PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $a = KeyboardButton::create('test');
        $this->assertInstanceOf(KeyboardButton::class, $a);
        $this->assertSame('test', $a->text);

        $b = KeyboardButton::create('test', KeyboardButton::REQUEST_LOCATION);
        $this->assertInstanceOf(KeyboardButton::class, $b);
        $this->assertSame('test', $a->text, $a);
        $this->assertSame(true, $b->request_location);

        $c = KeyboardButton::create('test', KeyboardButton::REQUEST_CONTACT);
        $this->assertInstanceOf(KeyboardButton::class, $c);
        $this->assertSame('test', $c->text);
        $this->assertSame(true, $c->request_contact);

        try {
            KeyboardButton::create('');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(InvalidArgumentException::class, $e);
        }

        try {
            KeyboardButton::create('foo', 'bar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(InvalidArgumentException::class, $e);
        }
    }
}