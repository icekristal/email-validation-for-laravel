<?php

namespace Icekristal\EmailValidationForLaravel\Facades;

use Icekristal\EmailValidationForLaravel\Services\EmailValidationService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static EmailValidationService setEmail(string $email)
 * @method static EmailValidationService isValidate()
 */
class EmailValidation extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ice.email_validation';
    }
}
