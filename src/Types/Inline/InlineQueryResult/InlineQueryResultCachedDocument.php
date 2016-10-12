<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Inline\InlineQueryResult;

/**
 * Represents a link to a file stored on the Telegram servers.
 * By default, this file will be sent by the user with an optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the file.
 * Currently, only pdf-files and zip archives can be sent using this method.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultcacheddocument
 *
 * @property string $title Title for the result.
 * @property string $document_file_id A valid file identifier for the file.
 * @property string $description Optional. Short description of the result.
 * @property string $caption Optional. Caption of the document to be sent, 0-200 characters.
 */
class InlineQueryResultCachedDocument extends InlineQueryResult
{
    const TYPE = 'document';
}