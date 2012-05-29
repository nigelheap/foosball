<?php

namespace Foosball\Controller;

use Zend\Mvc\Controller\AcitonController;
use Zend\View\Model\ViewModel;
use Foosball\Model\GameTable;
use Foosball\Model\PlayerTable;

class FoosballController extends ActionController
{
    protected $gameTable;

    /**
     * Our player model
     * @var \Foosball\Model\PlayerTable
     */
    protected $playerTable;
}

