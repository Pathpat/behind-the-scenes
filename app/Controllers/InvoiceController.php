<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\View;
use Carbon\Carbon;
use Symfony\Component\Mailer\MailerInterface;

use function Symfony\Component\Clock\now;

class InvoiceController
{
    #[Get(path: '/invoices')]
    public function index(): View
    {
        $invoices = Invoice::query()->where('status', InvoiceStatus::Paid)->get(
        )->toArray();

        return View::make('invoices/index', ['invoices' => $invoices]);
    }

    #[Get(path: '/invoice/new')]
    public function create()
    {
        $invoice = new Invoice();
        $invoice->amount = 50;
        $invoice->status = InvoiceStatus::Pending;
        $invoice->invoice_number = 'Invoice 222';
        $invoice->due_date = (new Carbon())->addDay();
        $invoice->save();

            echo $invoice->id . ', '. $invoice->due_date;
    }
}