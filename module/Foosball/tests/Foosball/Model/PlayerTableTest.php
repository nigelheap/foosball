<?php

namespace FoosballTest\Model;

use Foosball\Model;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfiguration;

class PlayerTableTest extends \PHPUnit_Framework_TestCase {

    /**
     * Our player table
     * @var Foosball\Model\PlayerTable
     */
    protected $p;

    public function setup()
    {
        // mock the adapter, driver, and parts
        $mockResult = $this->getMock('Zend\Db\Adapter\Driver\ResultInterface');
        $mockStatement = $this->getMock('Zend\Db\Adapter\Driver\StatementInterface');
        $mockStatement->expects($this->any())->method('execute')->will($this->returnValue($mockResult));
        $mockConnection = $this->getMock('Zend\Db\Adapter\Driver\ConnectionInterface');
        $mockDriver = $this->getMock('Zend\Db\Adapter\Driver\DriverInterface');
        $mockDriver->expects($this->any())->method('createStatement')->will($this->returnValue($mockStatement));
        $mockDriver->expects($this->any())->method('getConnection')->will($this->returnValue($mockConnection));

        // setup mock adapter
        $this->mockAdapter = $this->getMock('Zend\Db\Adapter\Adapter', null, array($mockDriver));
        $this->p = new Model\PlayerTable($this->mockAdapter);
    }

    /**
     * @expectedException Foosball\Model\Exception\FailedLoad
     */
    public function testFailLoad()
    {
        $player = $this->p->getPlayer(false);
    }

    public function testLoad()
    {
        $player = $this->p->getPlayer(1);

        $this->assertInstanceOf('Foosball\Model\Player', $player);
    }
}
