<?php
//return $connection = array(
//    'connections' => array(
//        'mysql' => array(
//            'driver' => 'mysql',
//            'host' => env('DB_HOST'),
//            'database' => 'carcovid19',
//            'username' => env('DB_USERNAME'),
//            'password' => env('DB_PASSWORD'),
//            'charset' => 'utf8'
//        ),
//        'mysql2' => array(
//            'driver' => 'mysql',
//            'host' => env('DB_HOST'),
//            'database' => 'auth_db',
//            'username' => env('DB_USERNAME'),
//            'password' => env('DB_PASSWORD'),
//            'charset' => 'utf8'
//        )
//    ),
//);
return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'mysql2' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'database' => env('DB2_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'mysql3' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'database' => env('DB3_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ]
];
?>
