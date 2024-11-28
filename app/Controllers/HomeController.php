<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Invoice;
use App\Models\SignUp;
use App\Models\User;
use App\View;


class HomeController
{

    /**
     * @throws \Throwable
     */
    public function index(): View
    {
        $email = 'yolo@doe.com';
        $name = 'Johan Doe';
        $amount = 25;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            ['email' => $email, 'name' => $name],
            ['amount' => $amount]
        );
//
        return View::make(
            'index',
            ['invoice' => $invoiceModel->find($invoiceId)]
        );
    }

    public function download(): void
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="myfile.pdf"');

        readfile(STORAGE_PATH.'/receipt-2024.pdf');
    }

    public function upload(): void
    {
        $filePath = STORAGE_PATH.'/'.$_FILES['receipt']['name'];

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        header('location: /');
        exit;
        unlink(STORAGE_PATH.'/Screenshot from 2024-11-20 01-52-37.pdf');
    }
}