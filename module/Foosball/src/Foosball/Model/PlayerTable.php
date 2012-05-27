<?php
namespace Foosball\Model;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

class PlayerTable extends TableGateway
{
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        parent::__construct('player', $adapter, $databaseSchema, $selectResultPrototype);
    }
}