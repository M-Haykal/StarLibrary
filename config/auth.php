<?php
return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Add a new guard for siswa
        'costumer' => [
            'driver' => 'session',
            'provider' => 'costumer',
        ],
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Add a new provider for siswa
        'costumer' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class, // Adjust the model accordingly
        ],
        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\petugas::class, // Adjust the model accordingly
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
