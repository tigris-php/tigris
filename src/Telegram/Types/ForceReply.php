<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Interfaces\ReplyMarkupInterface;

/**
 * Class ForceReply
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#forcereply
 *
 * @property boolean $force_reply
 * @property boolean $selective
 */
class ForceReply extends BaseObject implements ReplyMarkupInterface
{
    /**
     * Constructor
     * 
     * @param bool $selective
     * @return static
     */
    public static function create($selective = false)
    {
        $data = compact('selective');
        $data['force_reply'] = true;
        return static::build($data);
    }
}