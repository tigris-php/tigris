<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Base;

use Tigris\Telegram\Types\Interfaces\TypeInterface;

abstract class BaseArray extends \ArrayObject implements TypeInterface
{
    const ENTITY_CLASS = null;
    const DIMENSION = 1;
    
    /**
     * @inheritdoc
     * @return array
     */
    public static function parse($data)
    {
        if (static::ENTITY_CLASS == null) {
            throw new \LogicException('Please override ENTITY_CLASS constant in ' . __CLASS__);
        }

        if ($data instanceof TypeInterface) {
            return $data;
        }

        if (empty($data) || !is_array($data)) {
            return [];
        }

        return static::parseInternal($data, static::DIMENSION);
    }

    /**
     * @param array $data
     * @param int $level
     * @return array
     */
    protected static function parseInternal($data, $level)
    {
        $result = [];
        if ($level == 1) {
            /** @var TypeInterface $className */
            $className = static::ENTITY_CLASS;
            foreach ($data as $item) {
                $result[] = $className::parse($item);
            }
        } else {
            $level--;
            foreach ($data as $item) {
                $result[] = static::parseInternal($item, $level);
            }
        }

        return $result;
    }
}