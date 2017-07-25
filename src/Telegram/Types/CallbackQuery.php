<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class CallbackQuery
 * This object represents an incoming callback query from a callback button in an inline keyboard.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#callbackquery
 *
 * @property string $id
 * @property User $from
 * @property Message|null $message
 * @property string|null $inline_message_id
 * @property string $chat_instance
 * @property string|null $data
 * @property string|null $game_short_name
 */
class CallbackQuery extends BaseObject
{
    public static function fields()
    {
        return [
            'id' => ScalarString::class,
            'from' => User::class,
            'message' => Message::class,
            'inline_message_id' => ScalarString::class,
            'chat_instance' => ScalarString::class,
            'data' => ScalarString::class,
            'game_short_name' => ScalarString::class,
        ];
    }
}