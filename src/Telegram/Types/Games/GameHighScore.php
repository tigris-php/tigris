<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Games;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarInteger;
use Tigris\Telegram\Types\User;

/**
 * Class GameHighScore
 * @package Tigris\Telegram\Types\Games
 *
 * This object represents one row of the high scores table for a game.
 *
 * @property integer $position
 * @property User $user
 * @property integer $score
 */
class GameHighScore extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'position' => ScalarInteger::class,
            'user' => User::class,
            'score' => ScalarInteger::class,
        ];
    }
}