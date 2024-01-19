install:

```php
composer require icekristal/email-validation-for-laravel
```

migration:

```php
php artisan vendor:publish --provider="Icekristal\EmailValidationForLaravel\EmailValidationServiceProvider" --tag="migrations"
```

config:

```php
php artisan vendor:publish --provider="Icekristal\EmailValidationForLaravel\EmailValidationServiceProvider" --tag="config"
```

setting .env
```
ACTIVE_EMAIL_VALIDATION_SERVICES=smtpbz,abstractapi,emaillistverify
IS_CHECK_MULTIPLE_EMAIL_VALIDATION=false
IS_SAVE_RESULT_EMAIL_VALIDATION_DB=true
TIMEOUT_EMAIL_VALIDATION=30
IS_VALID_EMAIL_SHUTDOWN_SERVICE=true
IS_USE_SAVE_DB=true

```

active services:

smtpbz (https://smtp.bz):
```
 SMTPBZ_API_KEY=
 SMTPBZ_API_URL=
```
abstractapi (https://www.abstractapi.com/):
```
 ABSTRACT_API_KEY=
 ABSTRACT_API_URL=
```
emaillistverify (https://www.emaillistverify.com/):
```
 EMAILLISTVERIFY_API_KEY=
 EMAILLISTVERIFY_API_URL=
```

use

```
EmailValidation::setEmail('email@email.ru')->isValidate();
```

