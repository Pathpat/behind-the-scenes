<?php

declare(strict_types=1);

namespace App\Enums;

enum Color: string
{
    case Green = 'green';
    case Red = 'red';
    case Gray = 'gray';
    case Orange = 'orange';

    /**
     * Returns the prefix for html class
     * @return string
     */
    public function getClass(): string
    {
        return 'color-' . $this->value;
    }
}