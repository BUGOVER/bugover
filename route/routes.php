<?php
declare(strict_types=1);

/**
 *
 * Routing ♣♠♦♥
 */
$router = new Core\Router\Router();

/**
 *
 * -> routes ☺☻☺
 */
// Add the routes
$router->match('', ['controller' => 'home', 'action' => 'index']);
$router->match('user', ['controller' => 'user', 'action' => 'index']);
