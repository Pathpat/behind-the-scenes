<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Attributes\Route;
use App\Enums\HttpMethod;
use App\Services\InvoiceService;
use App\View;


class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    #[Get(path: '/')]
    #[Route(path: '/home', method: HttpMethod::Head)]
    public function index(): View
    {
        return View::make('index');
    }

    #[Post(path: '/')]
    public function store()
    {
    }

    #[Put(path: '/')]
    public function update()
    {
    }
}