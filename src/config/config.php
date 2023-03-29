<?php

declare(strict_types=1);

use GlovoPlugin\Api\TokenManager;
use GlovoPlugin\Api\ApiRequest;

return [
    'backend_api' => [
        'token_manager_class' => TokenManager::class,
        'api_handler_class' => ApiRequest::class,
        'url' => env('BACKEND_URL'),
        'login_url' => env('BACKEND_LOGIN_URL'),
        'refresh_url' => env('BACKEND_REFRESH_URL'),
        'username' => env('BACKEND_USERNAME'),
        'password' => env('BACKEND_PASSWORD'),
    ],
    'glovo_api' => [
        'url' => env('GLOVO_URL'),
        'token' => env('GLOVO_TOKEN'),
    ],
];
