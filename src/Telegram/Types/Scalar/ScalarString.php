<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Scalar;

use Tigris\Telegram\Types\Base\BaseScalar;

/**
 * Class ScalarString
 * @package Tigris\Types
 */
abstract class ScalarString extends BaseScalar
{
    /**
     * @inheritdoc
     * @return string
     */
    public static function readData($data)
    {
        return (string) $data;
    }
}