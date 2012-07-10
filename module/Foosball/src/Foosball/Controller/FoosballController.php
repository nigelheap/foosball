<?php

namespace Foosball\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Foosball\Model\GameTable;
use Foosball\Model\PlayerTable;

class FoosballController extends AbstractActionController
{
    protected $gameTable;

    /**
     * Our player model
     * @var \Foosball\Model\PlayerTable
     */
    protected $playerTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'games' => 'this'
            // 'games' => $this->getGamesTable()->fetchAll(),
        ));
    }  
}
