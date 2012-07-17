<?php

namespace Foosball\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Foosball\Model\GameTable;
use Foosball\Model\PlayerTable;

class FoosballController extends AbstractActionController
{

    /**
     * Our player model
     * @var \Foosball\Model\PlayerTable
     */
    protected $playerTable;

    /**
     * Our game table model
     * @var \Foosball\Model\GameTable
     */
    protected $gameTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'games' => $this->getGameTable()->fetchAll(),
            ));
    }

    public function getGameTable()
    {
        if (!$this->gameTable) {
            $sm = $this->getServiceLocator();
            $this->gameTable = $sm->get('Foosball\Model\GameTable');
        }
        return $this->gameTable;
    }
}
