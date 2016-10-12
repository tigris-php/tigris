<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;

use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the contact.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultcontact
 *
 * @property string $phone_number Contact's phone number.
 * @property string $first_name Contact's first name.
 * @property string $last_name Optional. Contact's last name.
 * @property string $thumb_url Optional. Url of the thumbnail for the result.
 * @property string $thumb_width Optional. Thumbnail width.
 * @property string $thumb_height Optional. Thumbnail height.
 */
class InlineQueryResultContact extends AbstractInlineQueryResult
{
    const TYPE = 'contact';

    protected static function extraFields()
    {
        return [
            'phone_number' => ScalarString::class,
            'first_name' => ScalarString::class,
            'last_name' => ScalarString::class,
            'thumb_url' => ScalarString::class,
            'thumb_width' => ScalarInteger::class,
            'thumb_height' => ScalarInteger::class,
        ];
    }
}