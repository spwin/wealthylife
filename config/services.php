<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    //Socialite
    'facebook' => [
        'client_id'     => '1646316419027352',
        'client_secret' => 'ca207d8a861fb8051128ce633d57bedb',
        'redirect'      => env('APP_URL').'/social-callback/facebook',
    ],
    'twitter' => [
        'client_id'     => 'B2YDFF5kTv4OemGUnraGYHG3b',
        'client_secret' => 'vjzJWcUpQjbEkUl8nAxYJgTC9NAEMg90UfeSEkCZDuYBphXYXC',
        'redirect'      => env('APP_URL').'/social-callback/twitter',
    ],
    'google' => [
        'client_id'     => '434097911873-3fnag8odt44il7vrr6vi8mj5ktmb8a2i.apps.googleusercontent.com',
        'client_secret' => 'D5ACP0Q9UElPtLOriD9CyxX7',
        'redirect'      => env('APP_URL').'/social-callback/google',
    ],

    //Braintree configuration
    'braintree' => [
        'model'  => App\User::class,
        'environment' => env('BRAINTREE_ENV'),
        'merchant_id' => env('BRAINTREE_MERCHANT_ID'),
        'public_key' => env('BRAINTREE_PUBLIC_KEY'),
        'private_key' => env('BRAINTREE_PRIVATE_KEY'),
    ],
];
