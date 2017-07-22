<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Arrays;

use Tigris\Telegram\Types\Base\BaseArray;
use Tigris\Telegram\Types\ChatMember;

/**
 * @package Tigris\Types
 */
class ChatMemberArray extends BaseArray
{
    const ENTITY_CLASS = ChatMember::class;
}