<?php
namespace Foosball\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class PlayerTable extends TableGateway
{
    public function __construct(Adapter $adapter = null)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Player);

        $this->initialize();
    }

    public function load()
    {
    }

    public function loaded()
    {
    }
}
