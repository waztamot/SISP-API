<?php

return [
    'oracle' => [
        'driver'        => 'oracle',
        'tns'           => env('DB_TNS', ''),
        'host'          => env('DB_HOST', ''),
        'port'          => env('DB_PORT', '1521'),
        'database'      => env('DB_DATABASE', ''),
        'username'      => env('DB_USERNAME', ''),
        'password'      => env('DB_PASSWORD', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        //'schema'        => env('DB_SCHEMA',''),
    ],

    'oracle_ex' => [
        'driver'        => 'oracle',
        'tns'           => env('DB_TNS_EX', ''),
        'host'          => env('DB_HOST_EX', ''),
        'port'          => env('DB_PORT_EX', '1521'),
        'database'      => env('DB_DATABASE_EX', ''),
        'username'      => env('DB_USERNAME_EX', ''),
        'password'      => env('DB_PASSWORD_EX', ''),
        'charset'       => env('DB_CHARSET_EX', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX_EX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX_EX', ''),
        //'schema'        => env('DB_SCHEMA_EX',''),
    ],
];
