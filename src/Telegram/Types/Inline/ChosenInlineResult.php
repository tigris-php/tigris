<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Telegram\Types\Inline;

use Tigris\Telegram\Types\Base\BaseObject;
use Tigris\Telegram\Types\Location;
use Tigris\Telegram\Types\Scalar\ScalarString;
use Tigris\Telegram\Types\User;

/**
 * Class ChosenInlineResult
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * @package Tigris\Types
 * @link https://core.telegram.org/bots/api#choseninlineresult
 *
 * @property string $result_id The unique identifier for the result that was chosen.
 * @property User $from The user that chose the result.
 * @property Location $location Optional. Sender location, only for bots that require user location.
 * @property string $inline_message_id Optional. Identifier of the sent inline message.
 *  Available only if there is an inline keyboard attached to the message.
 *  Will be also received in callback queries and can be used to edit the message.
 * @property string $query The query that was used to obtain the result.
 */
class ChosenInlineResult extends BaseObject
{
    /**
     * @inheritdoc
     */
    public static function fields()
    {
        return [
            'result_id' => ScalarString::class,
            'from' => User::class,
            'location' => Location::class,
            'inline_message_id' => ScalarString::class,
            'query' => ScalarString::class,
        ];
    }
}