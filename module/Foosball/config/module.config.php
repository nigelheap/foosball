<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Foosball\Controller\Index' => 'Foosball\Controller\FoosballController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'foosball' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/foosball[/:action][/:id]',
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
            'foosball' => __DIR__ . '/../view',
        ),
    ),
);