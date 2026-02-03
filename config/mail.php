<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    | Modified to read from config/api_gmail.json for assignment requirements
    */

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => (function() {
                $json = @file_get_contents(config_path('api_gmail.json'));
                if ($json) {
                    $config = json_decode($json, true);
                    return $config['api']['smtp_host'] ?? env('MAIL_HOST', 'smtp.gmail.com');
                }
                return env('MAIL_HOST', 'smtp.gmail.com');
            })(),
            'port' => (function() {
                $json = @file_get_contents(config_path('api_gmail.json'));
                if ($json) {
                    $config = json_decode($json, true);
                    return $config['api']['smtp_port'] ?? env('MAIL_PORT', 587);
                }
                return env('MAIL_PORT', 587);
            })(),
            'encryption' => (function() {
                $json = @file_get_contents(config_path('api_gmail.json'));
                if ($json) {
                    $config = json_decode($json, true);
                    return strtolower($config['api']['encryption'] ?? 'tls');
                }
                return env('MAIL_ENCRYPTION', 'tls');
            })(),
            'username' => (function() {
                $json = @file_get_contents(config_path('api_gmail.json'));
                if ($json) {
                    $config = json_decode($json, true);
                    return $config['api']['email'] ?? env('MAIL_USERNAME');
                }
                return env('MAIL_USERNAME');
            })(),
            'password' => (function() {
                $json = @file_get_contents(config_path('api_gmail.json'));
                if ($json) {
                    $config = json_decode($json, true);
                    return $config['api']['app_password'] ?? env('MAIL_PASSWORD');
                }
                return env('MAIL_PASSWORD');
            })(),
            'timeout' => null,
            'auth_mode' => null,
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -t -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    | Modified to read from config/api_gmail.json
    */

    'from' => [
        'address' => (function() {
            $json = @file_get_contents(config_path('api_gmail.json'));
            if ($json) {
                $config = json_decode($json, true);
                return $config['api']['email'] ?? env('MAIL_FROM_ADDRESS', 'hello@example.com');
            }
            return env('MAIL_FROM_ADDRESS', 'hello@example.com');
        })(),
        'name' => (function() {
            $json = @file_get_contents(config_path('api_gmail.json'));
            if ($json) {
                $config = json_decode($json, true);
                return $config['notification_settings']['from_name'] ?? env('MAIL_FROM_NAME', 'Gudang Sparepart');
            }
            return env('MAIL_FROM_NAME', 'Gudang Sparepart');
        })(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
