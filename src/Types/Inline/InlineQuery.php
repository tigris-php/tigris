<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Location;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\User;

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
    protected static function fields()
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