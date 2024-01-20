<?php
return [
    'is_enable' => env('EMAIL_VALIDATION_IS_ENABLE', false),
    'enable_services' => explode(',', env('ACTIVE_EMAIL_VALIDATION_SERVICES', 'smtpbz,abstractapi,emaillistverify')),
    'is_check_multiple' => env('IS_CHECK_MULTIPLE_EMAIL_VALIDATION', false),
    'is_save_result_db' => env('IS_SAVE_RESULT_EMAIL_VALIDATION_DB', true),
    'timeout' => env('TIMEOUT_EMAIL_VALIDATION', 30),
    'is_valid_email_shutdown_service' => env('IS_VALID_EMAIL_SHUTDOWN_SERVICE', true),
    'is_use_save_db' => env('IS_USE_SAVE_DB', true),

    'services' => [
        'abstractapi' => [
            'api_key' => env('ABSTRACT_API_KEY'),
            'api_url' => env('ABSTRACT_API_URL', 'https://emailvalidation.abstractapi.com/v1'),
            'class' => \Icekristal\EmailValidationForLaravel\Services\AbstractApi::class,
        ],
        'emaillistverify' => [
            'api_key' => env('EMAILLISTVERIFY_API_KEY'),
            'api_url' => env('EMAILLISTVERIFY_API_URL', 'https://apps.emaillistverify.com/api/verifyEmail'),
            'class' => \Icekristal\EmailValidationForLaravel\Services\EmailListVerify::class,
        ],
        'smtpbz' => [
            'api_key' => env('SMTPBZ_API_KEY'),
            'api_url' => env('SMTPBZ_API_URL', 'https://api.smtp.bz/v1/check/email'),
            'class' => \Icekristal\EmailValidationForLaravel\Services\SmtpBz::class,
        ],
    ]
];
