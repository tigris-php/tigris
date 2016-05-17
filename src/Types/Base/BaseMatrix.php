<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Base;

use Tigris\Helpers\ArrayHelper;
use Tigris\Traits\JsonTrait;
use Tigris\Types\Interfaces\TypeInterface;

abstract class BaseMatrix extends BaseArray implements TypeInterface
{
    use JsonTrait;

    const ENTITY_CLASS = null;
    
    /**
     * @inheritdoc
     */
    public static function build($data)
    {
        if (static::ENTITY_CLASS == null) {
            throw new \LogicException('Please override ENTITY_CLASS constant in ' . __CLASS__);
        }

        if ($data instanceof TypeInterface) {
            return $data;
        }

        $obj = new static;

        if (empty($data) || !is_array($data)) {
            return $obj;
        }

        $className = static::ENTITY_CLASS;

        foreach ($data as $item) {
            /** @var $className BaseObject */
            $obj->append(parent::build($item));
        }

        return $obj;
    }
}