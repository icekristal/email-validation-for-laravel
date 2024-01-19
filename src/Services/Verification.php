<?php

namespace Icekristal\EmailValidationForLaravel\Services;

use Interfaces\ValidationInterface;

class Verification
{
    protected string $apiKey;
    protected string $url;
    public string $email;
    protected int $timeout;
    public mixed $response;

    public function __construct()
    {
        $this->timeout = config('email_validation.timeout', 30);
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
