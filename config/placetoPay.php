<?php

return [
    'auth' => [
        'login' => env('PLACETO_PAY_KEY_ID'),
        'tranKey' => env('PLACETO_PAY_ACCESS_KEY'),
        'baseUrl' => env('PLACETO_PAY_BASE_URL'),
        'timeout' => 10,
    ]
];
