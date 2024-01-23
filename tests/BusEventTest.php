<?php
namespace MessageBus;
use PHPUnit\Framework\TestCase;

class BusEventTest extends TestCase {

    public function testImplementsEvent() {
        $event = new BusEvent('test');
        $this->assertInstanceOf(Event::class, $event);
    }

    public function testGetParams() {
        $event = new BusEvent('test', ['test']);
        $this->assertEquals(['test'], $event->getParams());
    }

    public function testGetParamsNone() {
        $event = new BusEvent('test');
        $this->assertEquals([], $event->getParams());
    }

    public function testGetName() {
        $event = new BusEvent('test');
        $this->assertSame('test', $event->getName());
    }

    public function testStopPropagation() {
        $event = new BusEvent('test');

        $this->assertFalse($event->isStopped());
        $event->stopPropagation();
        $this->assertTrue($event->isStopped());

    }
}
