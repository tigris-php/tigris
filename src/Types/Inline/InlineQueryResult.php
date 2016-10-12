<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultArticle;
use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultAudio;
use Tigris\Types\Inline\InlineQueryResult\InlineQueryResultContact;
use Tigris\Types\InlineKeyboardMarkup;

/**
 * This object represents one result of an inline query.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 *
 * @property string $type Type of the result.
 * @property string $id Unique identifier for this result, 1-64 Bytes.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message.
 * @property InputMessageContent $input_message_content Content of the message to be sent.
 */
abstract class InlineQueryResult extends BaseObject
{
    const TYPE = null;

    /**
     * @inheritdoc
     */
    public static function build($data)
    {
        if (static::TYPE === null) {
            throw new \LogicException('Please set the TYPE constant');
        }

        $result = parent::build($data);
        $result->offsetSet('type', static::TYPE);

        return $result;
    }
}