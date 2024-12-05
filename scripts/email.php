<?php

declare(strict_types=1);


use App\Container;
use App\Services\EmailService;


require __DIR__.'/../vendor/autoload.php';



$container = new Container();

(new App\App($container))->boot();

$container->get(EmailService::class)->sendQueuedEmails();