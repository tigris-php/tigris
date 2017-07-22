<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Types\Location;
use Tigris\Types\Venue;

class VenueTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = Venue::parse([
            'location' => [
                'longitude' => 0.5,
                'latitude' => 0.5,
            ],
            'title' => 'some title',
            'address' => 'some address',
            'foursquare_id' => '123',
        ]);

        $this->assertInstanceOf(Venue::class, $a);
        $this->assertAttributeInstanceOf(Location::class, 'location', $a);
        $this->assertAttributeSame('some title', 'title', $a);
        $this->assertAttributeSame('some address', 'address', $a);
        $this->assertAttributeSame('123', 'foursquare_id', $a);

        $b = Venue::parse($a);
        $this->assertSame($a, $b);

        $z = Venue::parse(null);
        $this->assertNull($z);

        try {
            Venue::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            Venue::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}
