<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\User;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Exceptions\TelegramTypeException;

class UserTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = User::build([
            'id' => 100500,
            'first_name' => 'Ivan',
            'last_name' => 'Ivanov',
            'username' => '@ivanivanov',
        ]);
        
        $this->assertInstanceOf(User::class, $a);
        $this->assertAttributeInstanceOf(ScalarInteger::class, 'id', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'first_name', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'last_name', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'username', $a);

        $b = User::build($a);
        $this->assertSame($a, $b);

        $z = User::build(null);
        $this->assertNull($z);

        try {
            User::build('scalar');
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            User::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
