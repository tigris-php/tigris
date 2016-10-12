# Tigris: Telegram Bot Framework #

[![Build Status](https://travis-ci.org/tigris-php/tigris.svg?branch=master)](https://travis-ci.org/tigris-php/tigris)
[![Join the chat at https://gitter.im/tigris-php/tigris](https://badges.gitter.im/tigris-php/tigris.svg)](https://gitter.im/tigris-php/tigris?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/tigris-php/tigris/master/LICENSE.md)

Tigris is a modern reactive event-driven Telegram bot framework written in PHP.

## Usage

*Extend the Tigris\Bot class to create your own bot implementation*
```php
class SampleBot extends \Tigris\Bot
{
    // bootstraping your bot
    public function bootstrap()
    {
        // registering event callback
        $this->addListener(MessageEvent::EVENT_TEXT_MESSAGE_RECEIVED, function(MessageEvent $event) {
            // sending your first message
            $this->api->sendMessage($event->message->chat->id, 'Hello World!');
        });   
    }
}
```
*Run the bot instance*
```php
$bot = SampleBot::create($apiToken);
$bot->run();
```

## License

MIT