<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Scalar;

use Tigris\Telegram\Types\Base\BaseScalar;

/**
 * Class ScalarBoolean
 * @package Tigris\Types
 */
abstract class ScalarBoolean extends BaseScalar
{
    /**
     * @inheritdoc
     * @return boolean
     */
    public static function readData($data)
    {
        return (boolean) $data;
    }
}