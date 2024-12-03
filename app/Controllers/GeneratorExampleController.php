<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Route;
use App\Models\Ticket;

class GeneratorExampleController
{
    public function __construct(private Ticket $ticketModel)
    {
    }

    #[Route(path: '/example/generator')]
    public function index(): void
    {
        foreach ($this->ticketModel->all() as $ticket) {
            echo $ticket['id'].':'.substr($ticket['content'], 0, 15).'<br>';
        }
    }

}