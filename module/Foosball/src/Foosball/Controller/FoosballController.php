<?php

namespace Foosball\Controller;

use Zend\Mvc\Controller\AcitonController,
    Zend\View\Model\ViewModel,
    Foosball\Model\GameTable,
    Foosball\Model\PlayerTable;

class FoosballController extends ActionController
{
    protected $gameTable;

    /**
     * Our player model
     * @var \Foosball\Model\PlayerTable
     */
    protected $playerTable;
}

