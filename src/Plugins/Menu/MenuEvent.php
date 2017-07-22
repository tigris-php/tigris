<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins\Menu;

use Tigris\Events\AbstractEvent;
use Tigris\Telegram\Types\Message;

class MenuEvent extends AbstractEvent
{
    const EVENT_ITEM_SELECTED = 'onMenuItemSelected';
    const EVENT_UNKNOWN_ITEM_SELECTED = 'onMenuUnknownItemSelected';

    /** @var Message */
    public $message;
    /** @var Menu */
    public $menu;
    /** @var MenuItem */
    public $item;

    /**
     * @param Menu $menu
     * @param Message $message

     * @return static
     */
    public static function create(Menu $menu, Message $message)
    {
        $event = new static();
        $event->message = $message;
        $event->menu = $menu;
        return $event;
    }
}