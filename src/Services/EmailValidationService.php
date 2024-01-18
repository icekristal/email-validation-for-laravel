<?php

namespace Icekristal\EmailValidationForLaravel\Services;

class EmailValidationService
{
    private array $enableService;
    private string $email;
    public function __construct()
    {
        $this->enableService = config('email_validation.enable_services');
    }

    public function validate($email)
    {
        return true;
    }

    public function getEnableService(): array
    {
        return $this->enableService;
    }

    public function sendRequest()
    {

    }

    public function setEmail(string $email): EmailValidationService
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
