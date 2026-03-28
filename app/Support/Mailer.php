<?php

namespace App\Support;

class Mailer
{
    public function send(string $to, string $subject, string $message): void
    {
        // Simulación
        // En real usarías SMTP, API, etc.
    }
}