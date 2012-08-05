<?php

namespace Foosball\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Foosball\Model\GameTable;
use Foosball\Model\Player;
use Foosball\Form\PlayerForm;

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

    /**
     * Player form
     * @var \Foosball\Model\Player
     */
    protected $playerForm;

    public function indexAction()
    {
        return new ViewModel(array(
            'players' => $this->getPlayerTable()->fetchAll(),
            'games' => $this->getGameTable()->fetchAll(),
            ));
    }

    public function addAction()
    {
        $form = new PlayerForm();

        $form->get('submit')->setAttribute('value', 'Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $player = new Player();
            $form->setInputFilter($player->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $player->exchangeArray($form->getData());
                $this->getPlayerTable()->savePlayer($player);

                // Redirect to players
                return $this->redirect()->toRoute('player');
            }
        }

        return array('form' => $form);
    }

    public function getGameTable()
    {
        if (!$this->gameTable) {
            $sm = $this->getServiceLocator();
            $this->gameTable = $sm->get('Foosball\Model\GameTable');
        }
        return $this->gameTable;
    }

    public function getPlayerTable()
    {
        if (!$this->playerTable) {
            $sm = $this->getServiceLocator();
            $this->playerTable = $sm->get('Foosball\Model\PlayerTable');
        }
        return $this->playerTable;
    }

    public function getPlayerForm()
    {
        if (!$this->playerForm) {
            $this->playerForm = new PlayerForm();
        }
    }
}
