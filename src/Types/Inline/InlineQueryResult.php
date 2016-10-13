<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\InlineKeyboardMarkup;

/**
 * This object represents one result of an inline query.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 *
 * @property string $type Type of the result.
 * @property string $id Unique identifier for this result, 1-64 Bytes.
 * @property InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message.
 * @property InputMessageContent|null $input_message_content Content of the message to be sent.
 */
abstract class InlineQueryResult extends BaseObject
{
    // override this constant in the child classes
    const TYPE = null;

    /**
     * @inheritdoc
     */
    public static function parse($data)
    {
        if (static::TYPE === null) {
            throw new \LogicException('Please override TYPE constant in ' . __CLASS__);
        }
        // setting type
        $data['type'] = static::TYPE;
        // calling parent constructor to get static instance
        return parent::parse($data);
    }

    /**
     * @param $id
     * @param InlineKeyboardMarkup|null $reply_markup
     * @param InputMessageContent|null $input_message_content
     * @return static
     */
    public static function create(
        $id,
        InlineKeyboardMarkup $reply_markup = null,
        InputMessageContent $input_message_content = null
    ){
        /** @var static $result */
        $result = static::build(compact(
            'id', 'reply_markup', 'input_message_content'
        ));
        return $result;
    }
}