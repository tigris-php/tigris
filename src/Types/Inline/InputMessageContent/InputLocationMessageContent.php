<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InputMessageContent;

use Tigris\Types\Scalar\ScalarFloat;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inputlocationmessagecontent
 *
 * @property float $latitude Latitude of the location in degrees.
 * @property float $longitude Longitude of the location in degrees.
 */
class InputLocationMessageContent extends AbstractInputMessageContent
{
    protected static function fields()
    {
        return [
            'latitude' => ScalarFloat::class,
            'longitude' => ScalarFloat::class,
        ];
    }
}