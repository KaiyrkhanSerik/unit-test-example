<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\SendEmailService;

final class MailchampEmailService implements SendEmailService
{
    public function sendEmail(string $from, string $to, string $text)
    {
        // представим что мы тут отправляем на почту письмо))

        return true;
    }
}
