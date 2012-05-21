<?php
/**
 * Setup autoloading
 */
function FoosballTest_Autoloader($class) 
{
    $class = ltrim($class, '\\');

    if (!preg_match('#^(Foosball(Test)?|PHPUnit)(\\\\|_)#', $class)) {
        return false;
    }

    // $segments = explode('\\', $class); // preg_split('#\\\\|_#', $class);//
    $segments = preg_split('#[\\\\_]#', $class); // preg_split('#\\\\|_#', $class);//
    $ns       = array_shift($segments);

    switch ($ns) {
        case 'Foosball':
            $file = dirname(__DIR__) . '/src/' . $ns . '/';
            break;
        default:
            $file = false;
            break;
    }

    if ($file) {
        $file .= implode('/', $segments) . '.php';
        if (file_exists($file)) {
            return include_once $file;
        }
    }

    $segments = explode('_', $class);
    $ns       = array_shift($segments);

    switch ($ns) {
        case 'Foosball':
            $file = dirname(__DIR__) . '/';
            break;
        default:
            return false;
    }
    $file .= implode('/', $segments) . '.php';

    if (file_exists($file)) {
        return include_once $file;
    }

    return false;
}

spl_autoload_register('FoosballTest_Autoloader', true, true);

