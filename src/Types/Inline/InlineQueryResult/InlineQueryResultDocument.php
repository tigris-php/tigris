<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;

use Tigris\Types\Scalar\ScalarInteger;
use Tigris\Types\Scalar\ScalarString;

/**
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the file.
 * Currently, only .PDF and .ZIP files can be sent using this method.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 *
 * @property string $title Title for the result.
 * @property string $caption Optional. Caption of the document to be sent, 0-200 characters.
 * @property string $document_url A valid URL for the file.
 * @property string $mime_type Mime type of the content of the file, either “application/pdf” or “application/zip”.
 * @property string $description Optional. Short description of the result.
 * @property string $thumb_url Optional. URL of the thumbnail (jpeg only) for the file.
 * @property integer $thumb_width Optional. Thumbnail width.
 * @property integer $thumb_height Optional. Thumbnail height.
 */
class InlineQueryResultDocument extends AbstractInlineQueryResult
{
    const TYPE = 'article';

    protected static function extraFields()
    {
        return [
            'title' => ScalarString::class,
            'caption' => ScalarString::class,
            'document_url' => ScalarString::class,
            'mime_type' => ScalarString::class,
            'description' => ScalarString::class,
            'thumb_url' => ScalarString::class,
            'thumb_width' => ScalarInteger::class,
            'thumb_height' => ScalarInteger::class,
        ];
    }
}