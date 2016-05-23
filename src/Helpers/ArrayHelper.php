<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Helpers;

use Tigris\Types\Base\BaseArray;
use Tigris\Types\Base\BaseObject;
use Tigris\Types\Base\BaseScalar;

class ArrayHelper
{
    /**
     * @param $data
     * @param $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public static function getValue($data, $key, $default = null)
    {
        if (!is_array($data)) {
            return $default;
        }

        if ($key == null) {
            throw new \InvalidArgumentException('Key is not set');
        }

        return isset($data[$key]) ? $data[$key] : $default;
    }
}