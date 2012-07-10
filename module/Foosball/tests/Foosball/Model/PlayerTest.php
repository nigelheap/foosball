<?php

namespace FoosballTest\Model;

use Foosball\Model\Player;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Our Player
     * @var Foosball\Model\Player
     */
    protected $p;

    public function setup ()
    {
        $this->p = new Player();
    }

    public function testNotLoaded() 
    {
        $this->assertFalse($this->p->loaded());
    }

    public function testLoad()
    {
        
    }
}
