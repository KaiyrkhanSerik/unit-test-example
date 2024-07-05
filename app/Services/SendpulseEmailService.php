<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\SendEmailService;

final class SendpulseEmailService implements SendEmailService
{
    public function sendEmail(string $from, string $to, string $text): bool
    {
        return true;
    }
}
