<?php

namespace FoosballTest\Model;

use Foosball\Model;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfiguration;

class PlayerTableTest extends \PHPUnit_Framework_TestCase {
    protected $p;

    public function setup()
    {
        $this->p = new Model\PlayerTable();
    }

    public function testFailedLoad()
    {
        try {
            $this->p->load('nonsensical');
        } catch (ModelLoadException $e) {
            $this->assertFalse($this->p->loaded());

            return;
        }

        $this->fail();

    }
}
