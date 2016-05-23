<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Exceptions\TelegramApiException;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Inline\InlineQuery;
use Tigris\Types\Scalar\ScalarInteger;

/**
 * Class Update
 * This object represents an incoming update.
 * 
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#update
 *
 * @property ScalarInteger $update_id
 * @property Message $message
 * @property InlineQuery $inline_query
 */
class Update extends BaseObject
{
    const TYPE_MESSAGE = 'message';
    const TYPE_INLINE_QUERY = 'inline_query';
    const TYPE_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
    const TYPE_CALLBACK_QUERY = 'callback_query';
    const TYPE_UNKNOWN = 'unknown';

    public $type;

    /**
     * @inheritdoc
     */
    public static function build($data)
    {
        /** @var static $obj */
        $obj = parent::build($data);
        if (!$obj) {
            return $obj;
        }
        $obj->type = self::detectType($data);
        return $obj;
    }

    protected static function fields()
    {
        return [
            'update_id' => ScalarInteger::class,
            'message' => Message::class,
            'inline_query' => InlineQuery::class,
//            'chosen_inline_result' => ChosenInlineResult::class,
//            'callback_query' => CallbackQuery::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'update_id',
        ];
    }

    /**
     * Detects update type
     *
     * @param $data
     * @return string
     * @throws TelegramApiException
     */
    protected static function detectType(array $data)
    {
        foreach([
            self::TYPE_MESSAGE,
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
}