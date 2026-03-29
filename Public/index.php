<?php
// PHP built-in server routing for static assets
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// 1. Afficher toutes les erreurs (pour le debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Démarrer la session
session_start();

require_once __DIR__ . '/../Core/Router.php';
require_once __DIR__ . '/../Core/Database.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require_once __DIR__ . '/../' . $class . '.php';
});

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

echo $router->resolve($uri, $method);