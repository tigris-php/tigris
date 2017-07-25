<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Base;

use Tigris\Telegram\TypeParser;
use Tigris\Telegram\Types\Interfaces\TypeInterface;

abstract class BaseObject extends \ArrayObject implements TypeInterface
{
//    public function __construct($input = null, $flags = 0, $iterator_class = "ArrayIterator") {
//        parent::__construct($input, static::ARRAY_AS_PROPS, $iterator_class);
//    }

    /**
     * @inheritdoc
     * @return static
     */
    public static function parse($data)
    {
        return TypeParser::parse(static::class, $data);
    }

    /**
     * @return array
     */
    public static function fields()
    {
        return [];
    }

    /**
     * Builds object from array of field values indexed by field name.
     *
     * @param array $values
     * @return static
     */
    public static function build(array $values)
    {
        $result = new static;

        foreach ($values as $field => $value) {
            /** @var $className TypeInterface */
            $result->$field = $value;
        }

        return $result;
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

    public function __toString()
    {
        if ($this->offsetExists('id')) {
            return (string)$this->offsetGet('id');
        } else {
            return false;
        }
    }
}