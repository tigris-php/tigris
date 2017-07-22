<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace Tigris\Plugins\Menu;

use Tigris\Telegram\Types\KeyboardButton;

class MenuItem
{
    const TYPE_BUTTON = 'button';
    const TYPE_MENU = 'menu_link';
    const TYPE_REQUEST_CONTACT = 'request_contact';
    const TYPE_REQUEST_LOCATION = 'request_location';

    public $id;
    public $text;
    public $type = self::TYPE_BUTTON;
    public $targetMenuId;
    public $callback = null;

    /**
     * @param $text
     * @return static
     */
    public static function create($text)
    {
        $item = new static();
        $item->id = $text;
        $item->text = $text;
        return $item;
    }

    /**
     * Sets the item id to provided value.
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * This item must open the $menu menu.
     *
     * @param string|Menu $menu
     * @return $this
     */
    public function bindMenu($menu)
    {
        if ($menu instanceof Menu) {
            $menu = $menu->id;
        }
        $this->type = self::TYPE_MENU;
        $this->targetMenuId = $menu;
        return $this;
    }

    /**
     * This item must request contact.
     *
     * @return $this
     */
    public function requestContact()
    {
        $this->type = self::TYPE_REQUEST_CONTACT;
        return $this;
    }

    /**
     * This item must request location.
     *
     * @return $this
     */
    public function requestLocation()
    {
        $this->type = self::TYPE_REQUEST_LOCATION;
        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function bind($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @return KeyboardButton
     */
    public function toKeyboardButton()
    {
        switch ($this->type) {
            case self::TYPE_BUTTON:
            case self::TYPE_MENU:
                return KeyboardButton::create($this->text);
            case self::TYPE_REQUEST_CONTACT:
                return KeyboardButton::create($this->text, KeyboardButton::REQUEST_CONTACT);
            case self::TYPE_REQUEST_LOCATION:
                return KeyboardButton::create($this->text, KeyboardButton::REQUEST_LOCATION);
            default:
                throw new \LogicException('Unsupported item type: ' . $this->type);
        }
    }
}