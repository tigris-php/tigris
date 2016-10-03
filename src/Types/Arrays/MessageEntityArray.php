<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseArray;
use Tigris\Types\MessageEntity;

/**
 * Class MessageEntityArray
 * @package Tigris\Types
 */
class MessageEntityArray extends BaseArray
{
    const ENTITY_CLASS = MessageEntity::class;
}