<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Foosball\Controller\Index' => 'Foosball\Controller\FoosballController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'player' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/player[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Foosball\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),    

    'view_manager' => array(
        'template_path_stack' => array(
            'player' => __DIR__ . '/../view',
        ),
    ),
);
