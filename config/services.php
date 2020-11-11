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

    'facebook' => [
        'page-token' => env('FACEBOOK_PAGE_TOKEN', 'EAAFYHepqIXABALjkHHooJZBhtvnvHeZALfg2V6VYJsBVIQV8zNodi36g7MobZBcvfnjZBscCzO6ZAPlmS44wwStXJQaTRdZA56UlJqqeiiulIH7ZCdu2HwrkuBHFj760K4ZCNtxSPYxSU5Iel2EZBWUUCrkZCOA0VztBrx3I9ZBINMhDhbXRns007ql'),

        // Optional - Omit this if you want to use default version.
        'version'    => env('FACEBOOK_GRAPH_API_VERSION', '4.0'),

        // Optional - If set, the appsecret_proof will be sent to verify your page-token.
        'app-secret' => env('FACEBOOK_APP_SECRET', '745eac484156a0898b83645fff5d5878')
    ],

];
