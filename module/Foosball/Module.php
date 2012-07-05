<?php

namespace Foosball;

use Zend\Mvc\ModuleRouteListener;
use Foosball\Model\PlayerTable;

class Module
{
    public function onBootstrap($e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function initializeView($e)
    {
        $app          = $e->getParam('application');
        $basePath     = $app->getRequest()->getBasePath();
        $locator      = $app->getLocator();
        $renderer     = $locator->get('Zend\View\Renderer\PhpRenderer');
        $renderer->plugin('basePath')->setBasePath($basePath);
    }

    public function getServiceConfiguration()
    {
        return array(
            'factories' => array(
                'player-table' =>  function($sm) {
                    $dbAdapter = $sm->get('db-adapter');
                    $table = new PlayerTable($dbAdapter);
                    return $table;
                },
            ),
        );
    }
}
