<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Exceptions\TelegramTypeException;
use Tigris\Types\Location;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\Venue;

class VenueTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = Venue::build([
            'location' => [
                'longitude' => 0.5,
                'latitude' => 0.5,
            ],
            'title' => 123,
            'address' => 123,
            'foursquare_id' => 123,
        ]);

        $this->assertInstanceOf(Venue::class, $a);
        $this->assertAttributeInstanceOf(Location::class, 'location', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'title', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'address', $a);
        $this->assertAttributeInstanceOf(ScalarString::class, 'foursquare_id', $a);

        $b = Venue::build($a);
        $this->assertSame($a, $b);

        $z = Venue::build(null);
        $this->assertNull($z);

        try {
            Venue::build(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            Venue::build([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}