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
 * @property string $title
 * @property string|null $url
 * @property bool|null $hide_url
 * @property string|null $description
 * @property string|null $thumb_url
 * @property string|null $thumb_width
 * @property string|null $thumb_height
 */
class InlineQueryResultArticle extends InlineQueryResult
{
    const TYPE = 'article';
}