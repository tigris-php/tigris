<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\MessageEntity;

/**
 * Class MessageEntityArray
 * @package Tigris\Types
 */
class MessageEntityArray extends BaseArray
{
    const ENTITY_CLASS = MessageEntity::class;
}