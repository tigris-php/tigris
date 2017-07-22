<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline\InlineQueryResult;
use Tigris\Telegram\Types\Inline\InlineQueryResult;

/**
 * Represents a Game.
 *
 * @package Tigris\Types\Inline
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 *
 * @property string $game_short_name Short name of the game.
 */
class InlineQueryResultGame extends InlineQueryResult
{
    const TYPE = 'game';
}