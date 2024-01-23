<?php
namespace MessageBus;

class MessageBus {

	protected $listeners = [];

    public function subscribe(string $eventName, callable $handler) {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }

        $handlerId = count($this->listeners[$eventName]);
        $this->listeners[$eventName][] = $handler;
        return [$eventName, $handlerId];
    }

    public function fire(Event $event): array {
        return array_reduce(
            $this->getListeners($event->getName()),
            function(array $result, callable $handler) use ($event) : array {
                if (!$event->isStopped()) {
                    $result[] = $handler($event);
                }

                return $result;
            },
            []
        );

    }

    public function notify(string $eventName, ...$params) {
        $event = new BusEvent($eventName, $params);
        return $this->fire($event);
    }

    public function unsubscribe(array $subscription) {
        unset($this->listeners[$subscription[0]][$subscription[1]]);
    }

    protected function getListeners(string $name): array {
        $listeners = array_filter(
            $this->listeners,
            function($pattern) use ($name) {
                return fnmatch($pattern, $name);
            },
            ARRAY_FILTER_USE_KEY
        );

        if (empty($listeners)) {
            return [];
        }

        return array_merge(...array_values($listeners));
    }
}
