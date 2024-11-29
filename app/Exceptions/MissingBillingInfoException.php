<?php

declare(strict_types=1);

namespace App\Exceptions;

class MissingBillingInfoException extends \Exception
{
    protected $message = 'Missing billing info';
}