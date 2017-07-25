<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace Tigris\Telegram\Types\Stickers;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Scalar\ScalarBoolean;
use Tigris\Telegram\Types\Scalar\ScalarString;

/**
 * Class StickerSet
 * This object represents a sticker set.
 *
 * @package Tigris\Telegram\Types
 * @link https://core.telegram.org/bots/api#stickerset
 *
 * @property string $name
 * @property string $title
 * @property bool $contains_masks
 * @property Sticker[] $stickers
 */
class StickerSet extends BaseObject
{
    /**
     * @inheritdoc
     */
    public static function fields()
    {
        return [
            'name' => ScalarString::class,
            'title' => ScalarString::class,
            'contains_masks' => ScalarBoolean::class,
            'stickers' => [Sticker::class],
        ];
    }
}