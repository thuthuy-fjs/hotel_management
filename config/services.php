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
        'client_id'     => '212651184208-633db432t82a05qtc4grtqfpfbm6k0jl.apps.googleusercontent.com',
        'client_secret' => 'R5YtAegsniwE09fDQrDkdAIs',
        'redirect'      => 'http://localhost:8080/hotel_management/public/auth/google/callback',
    ],
//    'google' => [
//        'client_id'     => '212651184208-754u12d40u6ohdbtpnj0kbfrbosl9kf1.apps.googleusercontent.com',
//        'client_secret' => 'vX12q5nzm_V6gRGkfNGmmBmF',
//        'redirect'      => 'http://localhost:8080/hotel_management/public/admin/auth/google/callback',
//    ],
    'github' => [

        'client_id' => '2ef2958968ba55ae1a5f',

        'client_secret' => '5b460e67ac3b568cb8b93f53282ceb08f224c2c1',

        'redirect' => 'http://localhost:8080/hotel_management/public/auth/github/callback',

    ],
];
