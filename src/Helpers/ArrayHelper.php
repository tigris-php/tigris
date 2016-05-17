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

    public static function jsonEncode($obj, $encode = true)
    {
        $result = null;

        if ($obj instanceof BaseScalar) {
            $result = $obj->value;
        }

        if ($obj instanceof BaseObject || $obj instanceof BaseArray) {
            $array = $obj->getArrayCopy();
            array_walk($array, function(&$item) {
                $item = static::jsonEncode($item, false);
            });
            $result = array_filter($array);
        }

        return $encode ? json_encode($result) : $result;
    }
}