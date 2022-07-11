
<?php

use Illuminate\Support\Str;

return [

     /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'oracle_esaude_homolog'),

    'migrations' => 'migrations',

    'connections' => [

	    'oracle_esaude_homolog' => [
            'driver'         => 'oracle',
            'tns'            => env('DB_TNS', ''),
            'host'           => env('DB_HOST', 'SPADB5-HML.SPASAUDE.ORG.BR'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'ESAUDE'),
            'service_name'   => env('DB_SERVICENAME', 'SPADB05'),
            'username'       => env('DB_USERNAME', 'ESAUDE'),
            'password'       => env('DB_PASSWORD', 'ESAUDE'),
            'charset'        => env('DB_CHARSET', 'AL32UTF8'),
            'prefix'         => env('DB_PREFIX', ''),
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
            'edition'        => env('DB_EDITION', 'ora$base'),
            'server_version' => env('DB_SERVER_VERSION', '12g'),
            'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
            'dynamic'        => [],
        ],

        'oracle_esaude' => [
            'driver'         => 'oracle',
            'tns'            => env('DB_TNS', ''),
            'host'           => env('DB_HOST', 'SPADB2.SPASAUDE.ORG.BR'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'ESAUDE'),
            'service_name'   => env('DB_SERVICENAME', 'SPADB02'),
            'username'       => env('DB_USERNAME', 'ESAUDE'),
            'password'       => env('DB_PASSWORD', 'ESAUDE'),
            'charset'        => env('DB_CHARSET', 'AL32UTF8'),
            'prefix'         => env('DB_PREFIX', ''),
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
            'edition'        => env('DB_EDITION', 'ora$base'),
            'server_version' => env('DB_SERVER_VERSION', '12g'),
            'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
            'dynamic'        => [],
        ],

        'oracle_spasaude' => [
            'driver'         => 'oracle',
            'tns'            => env('DB_TNS', ''),
            'host'           => env('DB_HOST', 'SPADB3.SPASAUDE.ORG.BR'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'SIGSPA'),
            'service_name'   => env('DB_SERVICENAME', 'SPADB03'),
            'username'       => env('DB_USERNAME', 'SIGSPA'),
            'password'       => env('DB_PASSWORD', 'APSGIS'),
            'charset'        => env('DB_CHARSET', 'AL32UTF8'),
            'prefix'         => env('DB_PREFIX', ''),
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
            'edition'        => env('DB_EDITION', 'ora$base'),
            'server_version' => env('DB_SERVER_VERSION', '11c'),
            'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
            'dynamic'        => [],
        ],

        'oracle_smartadm' => [
            'driver'         => 'oracle',
            'tns'            => env('DB_TNS', ''),
            'host'           => env('DB_HOST', 'SPADB3.SPASAUDE.ORG.BR'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'SMARTADM'),
            'service_name'   => env('DB_SERVICENAME', 'SPADB03'),
            'username'       => env('DB_USERNAME', 'SMARTADM'),
            'password'       => env('DB_PASSWORD', 'spasaude123'),
            'charset'        => env('DB_CHARSET', 'AL32UTF8'),
            'prefix'         => env('DB_PREFIX', ''),
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
            'edition'        => env('DB_EDITION', 'ora$base'),
            'server_version' => env('DB_SERVER_VERSION', ''),
            'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
            'dynamic'        => [],
        ],

    ],

];
