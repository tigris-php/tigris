<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Base;

use Tigris\Telegram\Types\Interfaces\TypeInterface;
use Tigris\Traits\JsonTrait;

abstract class BaseArray extends \ArrayObject implements TypeInterface
{
    use JsonTrait;

    const ENTITY_CLASS = null;
    
    /**
     * @inheritdoc
     * @return static|array
     */
    public static function parse($data)
    {
        if (static::ENTITY_CLASS == null) {
            throw new \LogicException('Please override ENTITY_CLASS constant in ' . __CLASS__);
        }

        if ($data instanceof TypeInterface) {
            return $data;
        }

        $result = new static;

        if (empty($data) || !is_array($data)) {
            return $result;
        }

        $className = static::ENTITY_CLASS;

        foreach ($data as $item) {
            /** @var $className TypeInterface */
            $result->append($className::parse($item));
        }

        return $result;
    }
}