<?php
// DIC configuration

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO database library 
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $pdo = new PDO("sqlsrv:Server=" . $settings['host'] . ";Database=" . $settings['dbname'], $settings['user'], $settings['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
$container['dbERP'] = function ($c) {
    $settings = $c->get('settings')['dbERP'];
    $pdo = new PDO("sqlsrv:Server=" . $settings['host'] . ";Database=" . $settings['dbname'], $settings['user'], $settings['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
// $container['db'] = function ($c) {
//     $settings = $c->get('settings')['db'];
//     $pdo = new PDO(
//         "sqlsrv:Server=" . $settings['host'] . ";Database=" . $settings['dbname'],
//         NULL,
//         NULL,
//         array(PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT)
//     );
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//     return $pdo;
// };
