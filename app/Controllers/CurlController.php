<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Contracts\EmailValidationInterface;
use App\Services\Emailable\EmailValidationService;

class CurlController
{
    public function __construct(private EmailValidationInterface $emailValidationService)
    {
    }

    #[Get(path: '/curl')]
    public function index()
    {
        $email = $_ENV['EMAIL'];
       $result = $this->emailValidationService->verify($email);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }

}