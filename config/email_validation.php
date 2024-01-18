<?php
return [
    'enable_services' => explode(',', env('ACTIVE_EMAIL_VALIDATION_SERVICES', 'smtpbz,abstractapi,emaillistverify')),
    'is_check_multiple' => env('IS_CHECK_MULTIPLE_EMAIL_VALIDATION', false),
    'is_save_result_db' => env('IS_SAVE_RESULT_EMAIL_VALIDATION_DB', true),
    'timeout' => env('TIMEOUT_EMAIL_VALIDATION', 30),
    'is_valid_email_shutdown_service' => env('IS_VALID_EMAIL_SHUTDOWN_SERVICE', true),

    'services' => [
        'abstractapi' => [
            'api_key' => env('ABSTRACT_API_KEY'),
            'api_url' => env('ABSTRACT_API_URL', 'https://emailvalidation.abstractapi.com/v1'),
        ],
        'emaillistverify' => [
            'api_key' => env('EMAILLISTVERIFY_API_KEY'),
            'api_url' => env('EMAILLISTVERIFY_API_URL', 'https://apps.emaillistverify.com/api/verifyEmail'),
        ],
        'smtpbz' => [
            'api_key' => env('SMTPBZ_API_KEY'),
            'api_url' => env('SMTPBZ_API_URL', 'https://api.smtp.bz/v1/check/email'),
        ],
    ]
];
