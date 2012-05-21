<?php

/*
 * Set error reporting to the level to which Zend Framework code must comply.
 */
error_reporting( E_ALL | E_STRICT );

$phpUnitVersion = PHPUnit_Runner_Version::id();
if ('@package_version@' !== $phpUnitVersion && version_compare($phpUnitVersion, '3.5.0', '<')) {
    echo 'This version of PHPUnit (' . PHPUnit_Runner_Version::id() . ') is not supported in Zend Framework 2.x unit tests.' . PHP_EOL;
    exit(1);
}
unset($phpUnitVersion);

/*
 * Determine the root, library, and tests directories of the framework
 * distribution.
 */
$docRoot        = realpath(dirname(__DIR__) . '/../../');
$zfCore = "$docRoot/vendor/ZendFramework";
$foosballTests   = "$docRoot/module/Foosball/tests";

/*
 * Prepend the Zend Framework library/ and tests/ directories to the
 * include_path. This allows the tests to run out of the box and helps prevent
 * loading other copies of the framework code and tests that would supersede
 * this copy.
 */
$path = array(
    $zfCore . '/library',
    $foosballTests,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

/**
 * Setup autoloading
 */
include __DIR__ . '/_autoload.php';
include $zfCore . '/tests/_autoload.php';

/*
 * Unset global variables that are no longer needed.
 */
unset($zfRoot, $zfCore, $foosballTests, $path);

