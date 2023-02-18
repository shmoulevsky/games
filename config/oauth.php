<?php

return [
    'vk' => [
        'client_id' => env('VK_CLIENT_ID'),
        'client_secret' => env('VK_CLIENT_SECRET'),
        'redirect' => env('VK_REDIRECT'),
        'base_auth_url' => env('VK_BASE_AUTH_URL'),
        'base_api_url' => env('VK_BASE_API_URL'),
        'api_version' => env('VK_API_VERSION'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],
];
