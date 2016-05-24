<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Location;
use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;
use Tigris\Types\User;

/**
 * Class InlineQuery
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#inlinequery
 *
 * @property ScalarInteger $id
 * @property User $from
 * @property Location $location
 * @property ScalarString $query
 * @property ScalarString $offset
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