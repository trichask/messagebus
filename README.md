messagebus
==========

A simple Message Bus implementation

Example usage
-------------

Simple example
```php
<?php
namespace MessageBus;

$bus = new MessageBus();

$bus->subscribe('some.event', function (Event $event) {
    $params = $event->getParams();
    // do something
});

$bus->fire(new BusEvent('some.event', ['data']));
```
