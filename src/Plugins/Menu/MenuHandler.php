<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins\Menu;

use Tigris\Plugins\AbstractPlugin;
use Tigris\Events\MessageEvent;

class MenuHandler extends AbstractPlugin
{
    const STATE_PREFIX = 'menu_';

    /**
     * @inheritdoc
     */
    public function bootstrap()
    {
        $this->bot->addListener(MenuEvent::EVENT_ITEM_SELECTED, [$this, 'onItemSelected']);
        $this->bot->addListener(MenuEvent::EVENT_UNKNOWN_ITEM_SELECTED, [$this, 'onUnknownItemSelected']);
        $this->bot->addListener(MessageEvent::EVENT_TEXT_MESSAGE_RECEIVED, [$this, 'onTextMessageReceived']);
    }

    public function onTextMessageReceived(MessageEvent $event)
    {
        // checking state
        $session = $this->bot->getChatSession($event->message->chat->id);
        $state = $session->getState();
        if ($state == null || strpos($state, self::STATE_PREFIX) !== 0) {
            return;
        }

        // looking for the menu object
        $menuId = substr($state, strlen(self::STATE_PREFIX));
        $menu = Menu::get($menuId);
        if (!$menu) {
            $session->clearState();
            return;
        }

        $message = $event->message;

        // detecting item
        $items = [];
        array_walk_recursive($menu->items, function(MenuItem $item) use (&$items) { $items[] = $item; });
        $selectedItem = array_reduce($items, function($carry, MenuItem $item) use ($message) {
            if ($carry) {
                return $carry;
            }
            if ($message->text == $item->text) {
                return $item;
            }
            return null;
        });

        // sending events
        $menuEvent = MenuEvent::create($menu, $event->message);
        if ($selectedItem) {
            $menuEvent->item = $selectedItem;
            $this->bot->emit(MenuEvent::EVENT_ITEM_SELECTED, $menuEvent);
        } else {
            $this->bot->emit(MenuEvent::EVENT_UNKNOWN_ITEM_SELECTED, $menuEvent);
        }

        $event->handled = true;
    }

    /**
     * Default implementation handles menu items with type menu.
     *
     * @param MenuEvent $event
     */
    public function onItemSelected(MenuEvent $event)
    {
        switch ($event->item->type) {
            case MenuItem::TYPE_MENU_LINK:
                $event->handled = true;
                Menu::send($event->message->chat->id, $event->item->targetMenuId);
                return;
        }
        Menu::send($event->message->chat->id, $event->menu->id);
    }

    /**
     * Default implementation sends the menu again.
     *
     * @param MenuEvent $event
     */
    public function onUnknownItemSelected(MenuEvent $event)
    {
        $event->handled = true;
        Menu::send($event->message->chat->id, $event->menu->id);
    }
}