<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Types\Audio;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Inline\InlineQuery;
use Tigris\Types\User;
use Tigris\Types\Location;

class InlineQueryTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQuery::build([
            'id' => 'foobar',
            'from' => [
                'id' => 100500,
                'first_name' => 'Tigris',
                'last_name' => 'Bot',
                'username' => '@tigrisbot',
            ],
            'location' => [
                'longitude' => 0.5,
                'latitude' => 0.5,
            ],
            'query' => 'foo',
            'offset' => 'bar',
        ]);
        
        $this->assertInstanceOf(InlineQuery::class, $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'id', $a);
        $this->assertAttributeInstanceOf(User::class, 'from', $a);
        $this->assertAttributeInstanceOf(Location::class, 'location', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'query', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'offset', $a);

        $b = InlineQuery::build($a);
        $this->assertSame($a, $b);

        $z = InlineQuery::build(null);
        $this->assertNull($z);

        try {
            InlineQuery::build(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            InlineQuery::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
