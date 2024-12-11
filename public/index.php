<?php

declare(strict_types=1);


use App\Controllers\CurlController;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Router;
use Illuminate\Container\Container;

require __DIR__.'/../vendor/autoload.php';

const STORAGE_PATH = __DIR__.'/../storage';
const VIEW_PATH = __DIR__.'/../views';

$container = new Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttributes([
    HomeController::class,
    InvoiceController::class,
    CurlController::class,
]);

(new App\App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
))->boot()->run();