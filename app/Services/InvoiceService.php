<?php

declare(strict_types=1);

namespace App\Services;

class InvoiceService
{
    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayService $gatewayService,
        protected EmailService $emailService
    ) {
    }

    public function process(array $customer, float $amount): bool
    {
        //1. calculate sales tax
        $tax = $this->salesTaxService->calculate($amount, $customer);

        //2. process invoice
        if (!$this->gatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        //3. send email
        $this->emailService->send($customer, 'Receipt');

        return true;
    }
}