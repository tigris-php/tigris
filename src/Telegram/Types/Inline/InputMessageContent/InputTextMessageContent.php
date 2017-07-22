<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InputMessageContent;

use Tigris\Telegram\Types\Inline\InputMessageContent;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 *
 * @property string $message_text Text of the message to be sent, 1-4096 characters.
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic,
 *  fixed-width text or inline URLs in your bot's message.
 * @property bool $disable_web_page_preview Optional. Disables link previews for links in the sent message.
 */
class InputTextMessageContent extends InputMessageContent
{

}