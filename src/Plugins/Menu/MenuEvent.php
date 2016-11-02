<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins\Menu;

use Tigris\Events\AbstractEvent;
use Tigris\Types\Message;

class MenuEvent extends AbstractEvent
{
    const EVENT_ITEM_SELECTED = 'onMenuItemSelected';
    const EVENT_UNKNOWN_ITEM_SELECTED = 'onMenuUnknownItemSelected';

    /** @var Message */
    public $message;
    /** @var MenuObject */
    public $menu;
    /** @var MenuItem */
    public $item;

    /**
     * @param MenuObject $menu
     * @param Message $message

     * @return static
     */
    public static function create(MenuObject $menu, Message $message)
    {
        $event = new static();
        $event->message = $message;
        $event->menu = $menu;
        return $event;
    }
}