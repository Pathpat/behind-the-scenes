<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Models\Email;
use App\View;
use Symfony\Component\Mime\Address;

class UserController
{

    #[Get(path: '/users/create')]
    public function create(): View
    {
        return View::make('users/register');
    }

    #[Post(path: '/users')]
    public function register(): void
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
Hello {$firstName},

Thank you for signing up!
Body;

        $html = <<<HTML
<h1 style="text-align: center; color: blue;">Welcome</h1>
Hello $firstName,
<br/> <br/>
Thank you for signing up!
HTML;

        (new Email())->queue(
            new Address($email),
            new Address('suport@example.com', 'Support'),
            'Welcome!!',
            $html,
            $text
        );
    }
}