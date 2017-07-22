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
 * If the button that originated the query was attached to a message sent by the bot, the field message will be present.
 * If the button was attached to a message sent via the bot (in inline mode),
 * the field inline_message_id will be present. Exactly one of the fields data or game_short_name will be present.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#callbackquery
 *
 * @property string $id Unique identifier for this query.
 * @property User $from Sender.
 * @property Message $message Optional. Message with the callback button that originated the query.
 *  Note that message content and message date will not be available if the message is too old.
 * @property string $inline_message_id Optional. Identifier of the message sent via the bot in inline mode,
 *  that originated the query.
 * @property string $chat_instance Identifier, uniquely corresponding to the chat to which the message with the
 *  callback button was sent. Useful for high scores in games.
 * @property string $data Optional. Data associated with the callback button. Be aware that a bad client can send
 *  arbitrary data in this field.
 * @property string $game_short_name Optional. Short name of a Game to be returned, serves as the unique identifier
 *  for the game
 */
class CallbackQuery extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
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