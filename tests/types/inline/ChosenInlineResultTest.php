<?php

/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Types\User;
use Tigris\Types\Location;
use \Tigris\Types\Inline\ChosenInlineResult;
use Tigris\Exceptions\TelegramTypeException;

class ChosenInlineResultTest extends PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $a = \Tigris\Types\Inline\ChosenInlineResult::parse([
            'result_id' => '121',
            'from' => [
                'id' => '711',
                'first_name' => 'Tigris',
                'last_name' => 'Bot',
                'username' => '@tigrisbot',
            ],
            'location' => [
                'longitude' => 0.5,
                'latitude' => 0.5,
            ],
            'inline_message_id' => '12',
            'query' => 'foo',
        ]);

        $this->assertInstanceOf(\Tigris\Types\Inline\ChosenInlineResult::class, $a);
        $this->assertAttributeSame('121', 'result_id', $a);
        $this->assertAttributeInstanceOf(User::class, 'from', $a);
        $this->assertAttributeInstanceOf(Location::class, 'location', $a);
        $this->assertAttributeSame('foo', 'query', $a);

        $b = ChosenInlineResult::parse($a);
        $this->assertSame($a, $b);

        $z = ChosenInlineResult::parse(null);
        $this->assertNull($z);

        try {
            ChosenInlineResult::parse(121);
            $this->fail('Expected exception not thrown');
        }  catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }

        try {
            ChosenInlineResult::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TelegramTypeException::class, $e);
        }
    }
}