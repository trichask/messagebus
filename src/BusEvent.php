<?php
namespace MessageBus;

class BusEvent implements Event {

    protected $params;
    protected $name;
    protected $stopped = false;

    public function __construct(string $name, array $params = []) {
        $this->params = $params;
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getParams(): array {
        return $this->params;
    }

    public function stopPropagation(): void {
        $this->stopped = true;
    }

    public function isStopped(): bool {
        return $this->stopped;
    }
}
