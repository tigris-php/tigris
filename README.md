# Tigris Bot Framework #

Tigris is modern Telegram bot framework written in PHP.
Currently it is in a deep alpha, so it's api is very unstable.

## Usage

*Extend the Tigris\Bot class to create your own bot implementation*
```php
class SampleBot extends \Tigris\Bot
{
    public function onTextMessage(Message $message)
    {
        $this->api->sendMessage($message->chat->id, 'Hello World!');
    }
}
```
*Run the bot instance*
```php
$bot = SampleBot::create($apiToken);
$receiver = new \Tigris\Receivers\PollingReceiver();
$bot->setReceiver($receiver);
$bot->run();
```

## License

MIT