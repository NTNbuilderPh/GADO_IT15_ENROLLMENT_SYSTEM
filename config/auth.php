<?php

return [

    'defaults' => [
        'guard'     => 'student',
        'passwords' => 'students',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        // Custom student guard for SIS integration
        'student' => [
            'driver'   => 'session',
            'provider' => 'students',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Student::class,  // fallback
        ],

        'students' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Student::class,
        ],
    ],

    'passwords' => [
        'students' => [
            'provider' => 'students',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];