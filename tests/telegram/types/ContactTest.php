<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\Contact;

class ContactTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = Contact::parse([
            'phone_number' => '+100500',
            'first_name' => 'Tigris',
            'last_name' => 'Bot',
            'user_id' => 123,
        ]);

        $this->assertInstanceOf(Contact::class, $a);
        $this->assertAttributeSame('+100500', 'phone_number', $a);
        $this->assertAttributeSame('Tigris', 'first_name', $a);
        $this->assertAttributeSame('Bot', 'last_name', $a);
        $this->assertAttributeSame(123, 'user_id', $a);

        $b = Contact::parse($a);
        $this->assertSame($a, $b);

        $z = Contact::parse(null);
        $this->assertNull($z);

        try {
            Contact::parse('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            Contact::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
