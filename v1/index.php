<?php
use Cms\Utils\DotEnv;
session_start();
/**
 * This file will handle the routes
 *
 * @author Acdaling Edusei
 */
$app_environment = 'prod';
$url = $_SERVER['REQUEST_URI']; //The request url
$method = $_SERVER['REQUEST_METHOD']; //The request method

// Load dependencies.
require_once __DIR__ . '/autoload.php';

// Load env files
(new DotEnv(__DIR__.'/.env.'.$app_environment))->load();

// Get routes.
$routes = require_once 'routes.php';

// Create router.
$router = new Cms\Utils\Router($routes);

// Run page.
$router->run($url, $method);
