<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\InlineKeyboardMarkup;

/**
 * Base class for the InlineQueryResult types.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 *
 * @property string $type Type of the result.
 * @property string $id Unique identifier for this result, 1-64 Bytes.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message.
 */
abstract class InlineQueryResult extends BaseObject
{
    const TYPE = null;

    /**
     * @inheritdoc
     */
    public static function build($data)
    {
        $result = parent::build($data);
        $result->offsetSet('type', static::TYPE);
        return $result;
    }

    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        $fields = [
            'type',
            'id',
            'reply_markup',
        ];

        return array_merge($fields, static::extraFields());
    }

    /**
     * @return array
     */
    abstract protected static function extraFields();
}