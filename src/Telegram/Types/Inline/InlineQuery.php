<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Location;
use Tigris\Telegram\Types\Scalar\ScalarString;
use Tigris\Telegram\Types\User;

/**
 * Class InlineQuery
 * This object represents an incoming inline query. When the user sends an empty query,
 * your bot could return some default or trending results.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#inlinequery
 *
 * @property string $id Unique identifier for this query.
 * @property User $from Sender.
 * @property Location $location Optional. Sender location, only for bots that request user location.
 * @property string $query Text of the query (up to 512 characters).
 * @property string $offset Offset of the results to be returned, can be controlled by the bot.
 */
class InlineQuery extends BaseObject
{
    /**
     * @inheritdoc
     */
    public static function fields()
    {
        return [
            'id' => ScalarString::class,
            'from' => User::class,
            'location' => Location::class,
            'query' => ScalarString::class,
            'offset' => ScalarString::class,
        ];
    }
}