<?php

declare(strict_types=1);

namespace App\Exception;

class ViewException extends \Exception
{


    public static function viewNotFound(): static
    {
        return new static('View not found');
    }

}