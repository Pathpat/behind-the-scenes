<?php

declare(strict_types=1);

namespace App\Exceptions;

class InvoiceException extends \Exception
{

    public static function missingBillingInfo(): static
    {
        return new static('Missing billing info');
    }

    public static function invalidInvoiceAmount(): static
    {
        return new static('Invalid invoice amount: ');
    }
}