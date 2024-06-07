<?php

namespace Test\Ease\Logger;

use Ease\Logger\Regent;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-11-28 at 21:17:33.
 */
class RegentTest extends \Test\Ease\AtomTest
{
    /**
     * @var Regent
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Regent([]);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers Ease\Logger\Regent::__construct
     */
    public function testConstructor()
    {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->__construct();
        $mock->__construct('syslog');
        $mock->__construct('console');
        $mock->__construct('file');
        $mock->__construct('std');
        $mock->__construct('email');
        $mock->__construct('eventlog');
        $mock->__construct('\Ease\Logger\ToFile');

        $this->assertEquals(
            ['memory', 'syslog', 'console', 'file', 'std', 'email', 'eventlog', '\Ease\Logger\ToFile'],
            array_keys($mock->loggers)
        );
    }

    /**
     * @covers Ease\Logger\Regent::takeMessage
     */
    public function testTakeMessage()
    {
        $this->assertEmpty($this->object->takeMessage());
    }

    /**
     * @covers Ease\Logger\Regent::getMessages
     */
    public function testgetMessages()
    {
        $this->assertTrue(is_array($this->object->getMessages()));
    }

    /**
     * @covers Ease\Logger\Regent::cleanMessages
     */
    public function testcleanMessages()
    {
        $this->object->cleanMessages();
        $this->assertEmpty($this->object->getMessages());
    }

    /**
     * @covers Ease\Logger\Regent::addToLog
     * @covers Ease\Logger\Loggingable::addToLog
     */
    public function testAddToLog()
    {
        $this->object->cleanMessages();
        $this->object->addToLog(get_class($this), 'Unit Test');
        $this->object->addToLog(get_class($this), 'Code Coverage', 'debug');
        $this->assertEquals(2, count($this->object->getMessages()));
    }

    /**
     * @covers Ease\Logger\Regent::addStatusObject
     */
    public function testAddStatusObject()
    {
        $this->object->cleanMessages();
        $message = 'Regent::addStatusObject Unit Test';
        $this->object->addStatusObject(new \Ease\Logger\Message($message), 'info');
        $this->assertEquals(1, count($this->object->getMessages()));
    }

    /**
     * @covers Ease\Logger\Regent::singleton
     */
    public function testSingleton()
    {
        $this->assertInstanceOf('Ease\Logger\Regent', Regent::singleton());
    }
}
