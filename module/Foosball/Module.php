<?php

namespace Foosball;

use Foosball\Model\PlayerTable;

class Module
{
    public function onBootstrap($e)
    {
        $application        = $e->getParam('application');
        $sharedEventManager = $application->events()->getSharedManager();
        $sharedEventManager->attach('application', 'bootstrap', array($this, 'initializeView'), 100);
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
