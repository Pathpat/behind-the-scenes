<?php

declare(strict_types=1);

namespace App\Exception;

class RouteException extends \Exception
{

    public static function routeNotFound(): static
    {
        return new static('404 Route not found');
    }
}