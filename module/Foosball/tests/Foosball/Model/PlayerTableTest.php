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

    public function testFailedLoad()
    {
        $this->assertFalse($this->p->loaded());
    }


    public function testExceptionLoad() {
        try {
            $this->p->load('nonsensical');
        } catch (ModelLoadException $e) {
            return;
        }
        
        $this->fail('Did not get ModelLoadException');
    }

    public function testLoadFromID() {
        $this->p->load(1);

        $this->assertTrue($this->p->loaded());
        $this->assertEquals(1, $this->p->id);
    }
}
