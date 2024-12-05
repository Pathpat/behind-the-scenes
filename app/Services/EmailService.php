<?php

declare(strict_types = 1);

namespace App\Services;

use App\Enums\EmailStatus;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class EmailService
{
    public function __construct(protected \App\Models\Email $emailModel, protected MailerInterface $mailer)
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendQueuedEmails(): void
    {
       $emails = $this->emailModel->getEmailsByStatus(EmailStatus::Queue);

       Foreach($emails as $email) {
           $meta = json_decode($email->meta, true);

           $emailMessage = (new Email())
               ->from($meta['from'])
               ->to($meta['to'])
               ->subject($email->subject)
               ->text($email->text_body)
               ->html($email->html_body);

           $this->mailer->send($emailMessage);
           $this->emailModel->markEmailSent($email->id);
       }
    }
    public function send(array $to, string $template): bool
    {
        sleep(1);

        return true;
    }
}