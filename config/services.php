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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'upayments' => [
        'test_mode'    => env('test_mode',1),
        'merchant_id'  => env('merchant_id','1201'),
        'username'     => env('username','test'),
        'password'     => env('password','test'),
        'api_key'      => env('api_key','jtest123'),
        'encrypted_api_key'  => env('encrypted_api_key','$2y$10$vGhL3q/nCxSD1CP0MpQ.IOhwqs.EvyPNH3UW2xe5S.qa/I7Ks3eJa'),
        'CurrencyCode' => env('CurrencyCode','KWD'),
        'live_url'     => env('live_url','https://uapi.upayments.com/api/v1/charge'),
        'test_url'     => env('test_url','https://sandboxapi.upayments.com/api/v1/charge'),
    ]

];
