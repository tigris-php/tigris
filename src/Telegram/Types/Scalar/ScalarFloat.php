<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Scalar;

use Tigris\Telegram\Types\Base\BaseScalar;

/**
 * Class ScalarFloat
 * @package Tigris\Types
 */
abstract class ScalarFloat extends BaseScalar
{
    /**
     * @inheritdoc
     * @return float
     */
    public static function readData($data)
    {
        return (float) $data;
    }
}