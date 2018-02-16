<?php

namespace Log;

use Log\Logger;
use Log\Handlers\StdoutHandler;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->logger = new Logger('test1');
    }

    public function testGetName()
    {
        $this->assertEquals('test1', $this->logger->getName());
    }

    public function testAddHAndler()
    {
        $this->logger->addHandler(new StdoutHandler());
        $this->assertEquals(1, sizeof($this->logger->getHandlers()));
    }

    /**
     * @depends testAddHAndler
     */
    public function testInfo()
    {
        try {
            $this->logger->info('Esto es un log string');
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->assertTrue(false);
        }
    }
}