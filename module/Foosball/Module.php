<?php

namespace Foosball;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Foosball\Model\PlayerTable;
use Foosball\Model\GameTable;
use Foosball\Model\Player;
use Zend\Form\Annotation\AnnotationBuilder;

class Module implements
    ServiceProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Foosball\Model\GameTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new GameTable($dbAdapter);
                    return $table;
                },
                'Foosball\Model\PlayerTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new PlayerTable($dbAdapter);
                    return $table;
                },
                'Foosball\Model\Player\Form' => function($sm) {
                    $player = new Player();
                    $builder = new AnnotationBuilder();
                    $form = $builder->createForm($player);
                    // $form->bind($user);
                    var_dump($form);exit;
                    return $form;
                }
            ),
        );
    }    

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
