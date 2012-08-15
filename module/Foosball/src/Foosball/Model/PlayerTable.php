<?php

namespace Foosball\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Foosball\Model\Exception\FailedLoad;

class PlayerTable extends AbstractTableGateway
{
    protected $table = 'fb_player';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Player());

        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getPlayer($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('p_id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new FailedLoad("Could not find row $id");
        }
        return $row;
    }

        public function savePlayer(PLayer $player)
    {
        $data = array(
            'p_firstname' => $player->firstname,
            'p_lastname'  => $player->lastname,
            'p_email'  => $player->email,
            'p_password'  => $player->password,
            'p_points'  => $player->points,
        );

        $id = (int)$player->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getPlayer($id)) {
                $this->update($data, array('p_id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deletePlayer($id)
    {
        $this->delete(array('id' => $id));
    }

}
