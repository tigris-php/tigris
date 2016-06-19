<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Contact;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

class ContactTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Contact::build([
            'phone_number' => '+100500',
            'first_name' => 'Tigris',
            'last_name' => 'Bot',
            'user_id' => 100500,
        ]);

        $this->assertInstanceOf(Contact::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'phone_number', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'first_name', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'last_name', $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'user_id', $a);

        $b = Contact::build($a);
        $this->assertSame($a, $b);

        $z = Contact::build(null);
        $this->assertNull($z);

        try {
            Contact::build('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Contact::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
