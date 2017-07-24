<?php
/**
 * @author Sergey Vasilev <doozookn@gmail.com>
 */
use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\Games\GameHighScore;
use Tigris\Telegram\Types\User;

class GameHighScoreTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $a = GameHighScore::parse([
            'position' => 123,
            'user' => [
                'user_id' => 123,
            ],
            'score' => 456,
        ]);

        $this->assertInstanceOf(GameHighScore::class, $a);
        $this->assertAttributeSame(123, 'position', $a);
        $this->assertAttributeSame(456, 'score', $a);
        $this->assertAttributeInstanceOf(User::class, 'user', $a);

        $b = GameHighScore::parse($a);
        $this->assertSame($b, $a);

        $z = GameHighScore::parse(null);
        $this->assertNull($z);

        try {
            GameHighScore::parse(123);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }

        try {
            GameHighScore::parse([]);
            $this->fail('Expected exception not thrown');
        } catch (\Exception $e) {
            $this->assertInstanceOf(TypeException::class, $e);
        }
    }
}