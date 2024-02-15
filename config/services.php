<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'smsc' => [
        'login' => env('SMSC_LOGIN', 'hublotik'),
        'password' => env('SMSC_PASSWORD', '#'),
        'post' => 1,             // использовать метод POST
        'https' => 1,            // использовать HTTPS протокол
        'charset' => 'utf-8',    // кодировка сообщения: utf-8, koi8-r или windows-1251 (по умолчанию)
        'debug' => 0,             // флаг отладки
        'smtp_from' => 'api@smsc.ru', // e-mail адрес отправителя
    ],

];
