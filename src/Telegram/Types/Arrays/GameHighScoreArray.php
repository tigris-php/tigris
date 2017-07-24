<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\Games\GameHighScore;

/**
 * Class GameHighScoreArray
 * @package Tigris\Types
 */
class GameHighScoreArray extends BaseArray
{
    const ENTITY_CLASS = GameHighScore::class;
}