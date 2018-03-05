<?php
declare(strict_types=1);

/**
 * Front controller
 *
 * PHP version 7.2
 */
define('ROOT', __DIR__ . './../');

/**
 * Composer
 */
require ROOT . 'vendor/autoload.php';

/**
 * routes
 */
require_once ROOT . 'route/routes.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Exceptions\Error::errorHandler');
set_exception_handler('Core\Exceptions\Error::exceptionHandler');

/** @noinspection PhpUnhandledExceptionInspection */
$router->run();
