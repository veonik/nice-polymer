<?php

use Nice\Extension\DoctrineDbalExtension;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nice\Application;
use Nice\Router\RouteCollector;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../../vendor/autoload.php';

// Enable Symfony debug error handlers
Symfony\Component\Debug\Debug::enable();

$app = new Application('dev', true, false);
$app->appendExtension(new DoctrineDbalExtension(array(
    'database' => array(
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'user'     => 'root',
        'password' => null
))));

// Configure your routes
$app->set('routes', function (RouteCollector $r) {
    $r->map('/posts.json', null, function (Application $app) {
        $conn = $app->get('doctrine.dbal.database_connection');

        $results = $conn->executeQuery("SELECT * FROM polymer.messages")->fetchAll();

        $results = array_map(function($result) {
            $result['favorite'] = (bool) $result['favorite'];

            return $result;
        }, $results);

        return new JsonResponse($results);
    });
});

// Run the application
$app->run();
