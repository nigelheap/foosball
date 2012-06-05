<?php
namespace Foosball\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class PlayerTable extends TableGateway
{
    protected $table = 'player';

    public function __construct(Adapter $adapter = null)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Player);

        $this->initialize();
    }

    public function getPlayer($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
}
