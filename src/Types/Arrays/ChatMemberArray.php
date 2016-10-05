<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Arrays;

use Tigris\Types\Base\BaseArray;
use Tigris\Types\ChatMember;

/**
 * @package Tigris\Types
 */
class ChatMemberArray extends BaseArray
{
    const ENTITY_CLASS = ChatMember::class;
}