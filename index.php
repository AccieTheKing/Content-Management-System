<?php
session_start();
/**
 * This file will handle the routes
 *
 * @author Acdaling Edusei
 */

$url = $_SERVER['REQUEST_URI']; //The request url
$method = $_SERVER['REQUEST_METHOD']; //The request method

// Load dependencies.
require_once 'autoload.php';

// Get routes.
$routes = require_once 'routes.php';

// Create router.
$router = new Cms\Utils\Router($routes);

// Run page.
$router->run($url, $method);
