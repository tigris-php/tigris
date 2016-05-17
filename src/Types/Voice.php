<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types;

use Tigris\Types\Base\BaseObject;

/**
 * Class Voice
 * This object represents a voice note.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#venue
 */
class Voice extends BaseObject
{
    /**
     * @inheritdoc
     */
    protected static function fields()
    {
        return [
            'file_id' => ScalarString::class,
            'duration' => ScalarInteger::class,
            'mime_type' => ScalarString::class,
            'file_size' => ScalarInteger::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function requiredFields()
    {
        return [
            'file_id',
            'duration',
        ];
    }
}