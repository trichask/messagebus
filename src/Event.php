<?php

namespace MessageBus;

interface Event {
    public function getName(): string;
    public function getParams(): array;
    public function stopPropagation(): void;
    public function isStopped(): bool;
}
