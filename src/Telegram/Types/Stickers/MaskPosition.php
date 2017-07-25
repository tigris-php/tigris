<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Stickers;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarFloat;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class MaskPosition
 * This object describes the position on faces where a mask should be placed by default.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#maskposition
 *
 * @property string $point
 * @property float $x_shift
 * @property float $y_shift
 * @property float $scale
 */
class MaskPosition extends BaseObject
{
    /**
     * @inheritdoc
     */
    public static function fields()
    {
        return [
            'name' => ScalarString::class,
            'x_shift' => ScalarFloat::class,
            'y_shift' => ScalarFloat::class,
            'scale' => ScalarFloat::class,
        ];
    }
}