<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\View;
use Twig\Environment as Twig;

class InvoiceController
{
    public function __construct(private Twig $twig)
    {
    }

    #[Get(path: '/invoices')]
    public function index(): string
    {
        $invoices = Invoice::query()
            ->where('status', InvoiceStatus::Paid)
            ->get()
            ->map(fn(Invoice $invoice) => [
                'invoiceNumber' => $invoice->invoice_number,
                'amount'        => $invoice->amount,
                'status'        => $invoice->status->toString(),
                'statusColor'   => $invoice->status->color()->getClass(),
                'dueDate'       => $invoice->due_date->toDateTimeString(),
            ]);

        return $this->twig->render('invoices/index.twig', ['invoices' => $invoices]);
    }
}