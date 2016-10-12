<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Types\Inline\InlineQueryResult;
use Tigris\Types\Inline\InlineQueryResult;

/**
 * Represents a link to an animated GIF file.
 * By default, this animated GIF file will be sent by the user with optional caption.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultgif
 *
 * @property string $gif_url A valid URL for the GIF file. File size must not exceed 1MB.
 * @property integer $gif_width Optional. Width of the GIF.
 * @property integer $gif_height Optional. Height of the GIF.
 * @property string $thumb_url URL of the static thumbnail for the result (jpeg or gif).
 * @property string $title Optional. Title for the result.
 * @property string $caption Optional. Caption of the GIF file to be sent, 0-200 characters.
 */
class InlineQueryResultGif extends InlineQueryResult
{
    const TYPE = 'gif';
}