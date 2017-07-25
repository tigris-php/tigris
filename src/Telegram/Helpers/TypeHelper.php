<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Helpers;

use Tigris\Telegram\Exceptions\TypeException;
use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Base\BaseScalar;
use Tigris\Telegram\Types\Interfaces\TypeInterface;

class TypeHelper
{
    public static function jsonEncode($value, $encode = true)
    {
        $result = null;

        if (is_scalar($value)) {
            $result = $value;
        } elseif ($value instanceof BaseObject) {
            $array = $value->getArrayCopy();
            array_walk($array, function (&$item) {
                $item = static::jsonEncode($item, false);
            });
            $result = array_filter($array);
        } elseif (is_array($value)) {
            $array = $value;
            array_walk($array, function (&$item) {
                $item = static::jsonEncode($item, false);
            });
            $result = array_filter($array);
        }

        return $encode ? json_encode($result) : $result;
    }

    /**
     * @param mixed $typeDef
     * @param mixed $data
     * @return array|mixed|null|BaseObject
     * @throws TypeException
     */
    public static function parse($typeDef, $data)
    {
        // null data leads to null object
        if (is_null($data)) {
            return null;
        }

        // already parsed
        if ($data instanceof TypeInterface) {
            if ($data instanceof $typeDef) {
                return $data;
            } else {
                throw new TypeException('Unexpected input type: ' . get_class($data));
            }
        }

        // parsing string definition
        if (is_string($typeDef)) {
            return self::parseString($typeDef, $data);
        }

        // parsing array definition
        if (is_array($typeDef)) {
            if (empty($data) || !is_array($data)) {
                return [];
            }

            return self::parseArray($typeDef[0], $data, isset($typeDef[1]) ? $typeDef[1] : 1);
        }

        throw new \InvalidArgumentException('Invalid type definition: ' . $typeDef);
    }

    /**
     * @param string $typeDef
     * @param mixed $data
     * @return BaseObject|mixed
     * @throws TypeException
     */
    private final static function parseString($typeDef, $data)
    {
        if (is_subclass_of($typeDef, BaseScalar::class)) {
            /** @var $typeDef BaseScalar */
            return $typeDef::readData($data);
        } elseif (is_subclass_of($typeDef, BaseObject::class)) {
            /** @var $typeDef BaseObject */
            if (!is_array($data)) {
                throw new TypeException('Input must be an array');
            }
            if (count($data) == null) {
                throw new TypeException('Unexpected empty array');
            }
            /** @var BaseObject $result */
            $result = new $typeDef;
            foreach ($typeDef::fields() as $field => $fieldDef) {
                $result->offsetSet($field, self::parse($fieldDef, isset($data[$field]) ? $data[$field] : null));
            }
            return $result;
        } else {
            throw new \InvalidArgumentException('Invalid type definition: ' . $typeDef);
        }
    }

    /**
     * @param mixed $typeDef
     * @param mixed $data
     * @param int $dimension
     * @return array
     */
    private final static function parseArray($typeDef, $data, $dimension)
    {
        $result = [];

        if ($dimension == 1) {
            foreach ($data as $item) {
                $result[] = self::parse($typeDef, $item);
            }
        } else {
            $dimension--;
            foreach ($data as $item) {
                $result[] = self::parseArray($typeDef, $item, $dimension);
            }
        }
        return $result;
    }
}