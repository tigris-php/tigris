<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Updates;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\CallbackQuery;
use Tigris\Telegram\Types\Inline\ChosenInlineResult;
use Tigris\Telegram\Types\Inline\InlineQuery;
use Tigris\Telegram\Types\Message;
use Tigris\Telegram\Types\Scalar\ScalarInteger;

/**
 * Class Update
 * This object represents an incoming update.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#update
 *
 * @property integer $update_id
 * @property Message $message
 * @property Message $edited_message
 * @property Message $channel_post
 * @property Message $edited_channel_post
 * @property InlineQuery $inline_query
 * @property ChosenInlineResult $chosen_inline_result
 * @property CallbackQuery $callback_query
 */
class Update extends BaseObject
{
    const TYPE_MESSAGE = 'message';
    const TYPE_EDITED_MESSAGE = 'edited_message';
    const TYPE_INLINE_QUERY = 'inline_query';
    const TYPE_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
    const TYPE_CALLBACK_QUERY = 'callback_query';
    const TYPE_UNKNOWN = 'unknown';

    public $type;

    /**
     * @inheritdoc
     */
    public static function parse($data)
    {
        /** @var static $obj */
        $obj = parent::parse($data);
        if (!$obj) {
            return $obj;
        }
        $obj->type = self::detectType($data);
        return $obj;
    }

    /**
     * Detects update type
     *
     * @param $data
     * @return string
     */
    protected static function detectType(array $data)
    {
        foreach ([
             self::TYPE_MESSAGE,
             self::TYPE_EDITED_MESSAGE,
             self::TYPE_INLINE_QUERY,
             self::TYPE_CHOSEN_INLINE_RESULT,
             self::TYPE_CALLBACK_QUERY,
         ] as $type) {
            if (isset($data[$type])) {
                return $type;
            }
        }
        return static::TYPE_UNKNOWN;
    }

    public static function fields()
    {
        return [
            'update_id' => ScalarInteger::class,
            'message' => Message::class,
            'edited_message' => Message::class,
            'inline_query' => InlineQuery::class,
            'chosen_inline_result' => ChosenInlineResult::class,
            'callback_query' => CallbackQuery::class,
        ];
    }
}