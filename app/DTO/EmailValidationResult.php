<?php

declare(strict_types=1);

namespace App\DTO;

class EmailValidationResult
{
    /**
     * @property  int   $score
     * @property  bool  $isDeliverable
     */
    public function __construct(
        public readonly int $score,
        public readonly bool $isDeliverable
    ) {
    }

}