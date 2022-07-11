<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    
    'guards' => [
        'web' => [
            'driver' => 'auth',
            'provider' => 'users',
        ],
    
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users'
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'oracle',
            'model'  =>  App\Models\User::class,
        ]
    ],

];