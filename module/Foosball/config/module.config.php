<?php
return array(
    // Routes for this module
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
                        'controller' => 'foosball/foosball',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),    

    // View setup for this module
    'view_manager' => array(
        'template_path_stack' => array(
            'foosball' => __DIR__ . '/../view',
        ),
    ),
);
