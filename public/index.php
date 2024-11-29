<?php

declare(strict_types=1);


use App\Config;
use App\Container;
use App\Router;



require __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
const STORAGE_PATH = __DIR__.'/../storage';
const VIEW_PATH = __DIR__.'/../views';

$container = new Container();
$router = new Router($container);

$router
    ->get('/', [App\Controllers\HomeController::class, 'index'])
    ->get('/download', [App\Controllers\HomeController::class, 'download'])
    ->post('/upload', [App\Controllers\HomeController::class, 'upload'])
    ->get('/invoice', [App\Controllers\InvoiceController::class, 'index'])
    ->get(
        '/invoice/create',
        [App\Controllers\InvoiceController::class, 'create']
    )
    ->post(
        '/invoice/create',
        [App\Controllers\InvoiceController::class, 'store']
    );


(new App\App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();