<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Contracts\Services\SendEmailService;

final class FakeSmsService implements SendEmailService
{
    public function sendEmail(string $from, string $to, string $text): bool
    {
        return true;
    }
}
