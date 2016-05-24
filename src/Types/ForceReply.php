<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;
use Tigris\Types\Scalar\ScalarBoolean;

/**
 * Class ForceReply
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#forcereply
 *
 * @property ScalarBoolean $force_reply
 * @property ScalarBoolean $selective
 */
class ForceReply extends BaseObject
{
    public static function create($selective = false)
    {
        $data = [
            'force_reply' => true,
            'selective' => $selective,
        ];
        return static::build($data);
    }
    
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'force_reply' => ScalarBoolean::class,
            'selective' => ScalarBoolean::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'force_reply',
        ];
    }
}