<?php

namespace Icekristal\EmailValidationForLaravel\Services;

use Icekristal\EmailValidationForLaravel\Models\EmailValidationService as EmailValidationModel;

class EmailValidationService
{
    private array $enableService;
    private string $email;

    public string $url;

    public function __construct()
    {
        $this->enableService = config('email_validation.enable_services');
    }

    public function isValidate(): bool
    {
        $isCheckDb = $this->isCheckDb();
        if(!is_null($isCheckDb)) return $isCheckDb;
        foreach ($this->enableService as $service) {

        }
        return config('email_validation.is_valid_email_shutdown_service', true);
    }

    public function getEnableService(): array
    {
        return $this->enableService;
    }

    public function isCheckDb(): bool|null
    {
        $modelCheck = EmailValidationModel::query()
            ->where('email', $this->email)
            ->first();

        if (is_null($modelCheck)) return null;
        return $modelCheck->is_valid;
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
