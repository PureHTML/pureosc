<?php

namespace Test\Ease\Logger;

use Ease\Logger\ToMemory;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-17 at 23:59:52.
 */
class ToMemoryTest extends \Test\Ease\AtomTest
{
    /**
     * @var Logger
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new ToMemory();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers Ease\Logger\ToMemory::singleton
     */
    public function testSingleton()
    {
        $this->assertInstanceOf('Ease\Logger\ToMemory', ToMemory::singleton());
    }

    /**
     * @covers Ease\Logger\ToMemory::addToLog
     */
    public function testAddToLog()
    {
        $this->assertEquals(4, $this->object->addToLog(get_class($this), 'test'));
    }

    /**
     * @covers Ease\Logger\ToMemory::getLogStyle
     */
    public function testGetLogStyle()
    {
        $this->assertEquals('color: black;', $this->object->getLogStyle());
        $this->assertEquals('', $this->object->getLogStyle('unexist'));
    }
}
