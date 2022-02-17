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

    'google' => [
        'client_id' => '1022814991853-3sq64dth9st2k4psrv1isaclo5vd0c43.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

    'github' => [
        'client_id' => '83755b07daf45d0b70bf',
        'client_secret' => '91299f74f2f7ebdfbad2725d8b19ffaf3e0426be',
        'redirect' => 'http://localhost:8000/auth/github/callback',
    ],

    'facebook' => [
        'client_id' => '282343677319313',
        'client_secret' => 'bdb4cd2f56c58eb1d70345f567b9b045',
        'redirect' => 'https://localhost:8000/callback/facebook',
    ],
];