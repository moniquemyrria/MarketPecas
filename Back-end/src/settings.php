<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database connection settings
        "db" => [
            "host" => "localhost",
            "dbname" => "MKTPECAS",
            "user" => "sa",
            "pass" => "1234"
        ],
        // Database connection settings
        "dbERP" => [
            "host" => "10.212.200.60",
            "dbname" => "TMPEDV12",
            "user" => "ped",
            "pass" => "PeD2019@"
        ],
        // "db" => [
        //     "host" => "MANPGI",
        //     "dbname" => "ATIVO_TESTE"
        // ],
    ],
];
