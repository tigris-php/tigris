<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a link to an article or web page.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @property string $title Title of the result.
 * @property string $url Optional. URL of the result.
 * @property boolean $hide_url Optional. Pass True, if you don't want the URL to be shown in the message.
 * @property string $description Optional. Short description of the result.
 * @property string $thumb_url Optional. Url of the thumbnail for the result.
 * @property string $thumb_width Optional. Thumbnail width.
 * @property string $thumb_height Optional. Thumbnail height.
 */
class InlineQueryResultArticle extends InlineQueryResult
{
    const TYPE = 'article';
}