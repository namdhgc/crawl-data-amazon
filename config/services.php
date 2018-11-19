<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'     => App\User::class,
        'key'       => env('STRIPE_KEY'),
        'secret'    => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id'     => '273582869783773',
        'client_secret' => '4ca1fe4e4287481948c7b83db9bdb0bc',
        'redirect'      => '',
    ],

    'google' => [
        'client_id'     => '814079201998-an58hsne2riefiiic0dsf1s48t3e4me1.apps.googleusercontent.com',
        'client_secret' => 'F-aa5Ghgvj354-Veh2NSYLTu',
        'redirect'      => '',
    ],
];
