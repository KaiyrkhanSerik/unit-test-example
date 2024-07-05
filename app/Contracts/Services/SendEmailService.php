<?php

declare(strict_types=1);

namespace App\Contracts\Services;

interface SendEmailService
{
    public function sendEmail(string $from, string $to, string $text): bool;
}
