<?php
namespace Foosball\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class PlayerTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        parent::__construct('player', $adapter, $databaseSchema, $selectResultPrototype);
    }
}
