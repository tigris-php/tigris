<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Arrays\MessageEntityArray;
use Tigris\Types\Arrays\PhotoSizeArray;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarString;

/**
 * Class Game
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique
 * identifiers.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#game
 *
 * @property string $title Title of the game.
 * @property string $description Description of the game.
 * @property PhotoSizeArray $photo Photo that will be displayed in the game message in chats.
 * @property string $text Optional. Brief description of the game or high scores included in the game message.
 *  Can be automatically edited to include current high scores for the game when the bot calls setGameScore,
 *  or manually edited using editMessageText. 0-4096 characters.
 * @property MessageEntityArray $text_entities Optional. Special entities that appear in text, such as usernames,
 *  URLs, bot commands, etc.
 * @property Animation $animation Optional. Animation that will be displayed in the game message in chats.
 *  Upload via BotFather.
 */
class Game extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'title' => ScalarString::class,
            'description' => ScalarString::class,
            'photo' => PhotoSizeArray::class,
            'text' => ScalarString::class,
            'text_entities' => MessageEntityArray::class,
            'animation' => Animation::class,
        ];
    }
}