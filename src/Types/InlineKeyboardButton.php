<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarString;

/**
 * This object represents one button of an inline keyboard.
 * You must use exactly one of the optional fields.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 *
 * @property string $text Label text on the button.
 * @property string|null $url Optional. HTTP url to be opened when button is pressed.
 * @property string|null $callback_data Optional. Data to be sent in a callback query to the bot
 *  when button is pressed, 1-64 bytes.
 * @property string|null $switch_inline_query Optional. If set, pressing the button will prompt the user to select one of
 *  their chats, open that chat and insert the bot‘s username and the specified inline query in the input field.
 *  Can be empty, in which case just the bot’s username will be inserted.
 * @property string|null $switch_inline_query_current_chat Optional. If set, pressing the button will insert the bot‘s
 *  username and the specified inline query in the current chat's input field.
 *  Can be empty, in which case only the bot’s username will be inserted.
 * @property CallbackGame|null $callback_game Optional. Description of the game that will be launched when the user presses the button.
 */
class InlineKeyboardButton extends BaseObject
{
    /**
     * @param $text
     * @param string|null $url
     * @param string|null $callback_data
     * @param string|null $switch_inline_query
     * @param string|null $switch_inline_query_current_chat
     * @param CallbackGame|null $callback_game
     * @return BaseObject|static
     */
    public static function create(
        $text,
        $url = null,
        $callback_data = null,
        $switch_inline_query = null,
        $switch_inline_query_current_chat = null,
        CallbackGame $callback_game = null
    ){
        // checking arguments
        $check = [
            $url,
            $callback_data,
            $switch_inline_query,
            $switch_inline_query_current_chat,
            $callback_game,
        ];
        $check = array_filter($check);
        if (count($check) > 1) {
            throw new \InvalidArgumentException('Please select exactly one of the optional fields');
        }
        // creating instance
        return static::build(compact(
            'text',
            'url',
            'callback_data',
            'switch_inline_query',
            'switch_inline_query_current_chat',
            'callback_game'
        ));
    }
}