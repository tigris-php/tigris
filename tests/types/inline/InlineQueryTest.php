<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Inline\InlineQuery;
use Tigris\Types\Location;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\User;

class InlineQueryTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = InlineQuery::parse([
            'id' => '123',
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
        $this->assertAttributeSame('123', 'id', $a);
        $this->assertAttributeInstanceOf(User::class, 'from', $a);
        $this->assertAttributeInstanceOf(Location::class, 'location', $a);
        $this->assertAttributeSame('foo', 'query', $a);
        $this->assertAttributeSame('bar', 'offset', $a);

        $b = InlineQuery::parse($a);
        $this->assertSame($a, $b);

        $z = InlineQuery::parse(null);
        $this->assertNull($z);

        try {
            InlineQuery::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            InlineQuery::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}
